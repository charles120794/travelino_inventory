<?php

namespace App\Http\Traits\Inventory;

use DB;
use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Model\Inventory\Activity\InventoryActivityCashier;
use App\Model\Inventory\Activity\InventoryActivityCashierDetails;

trait InventoryDashboardTrait
{
	public function inventory_dashboard_retrieve_orders($method, $id, $request)
	{
		$order_type = $request->get('order_type');

		$orders = (new InventoryActivityCashier)
						->where('cashier_purchase_type','order');
				
		if(request()->has('o_df') && request()->has('o_dt')) {
			$orders = $orders->where('cashier_date', '>=', request()->get('o_df'));
			$orders = $orders->where('cashier_date', '<=', request()->get('o_dt'));
		} else {
			$orders->whereDate('cashier_date', date('Y-m-d'));
		}

		if(request()->has('order_type')) {
			$orders = $orders->where('cashier_status_order', $order_type);
		}

		$orders = $orders->orderBy('cashier_date','asc')->paginate(10);

		return $this->myViewMethodLoader($method)->with('orders', $orders)->with('order_type', $order_type);
	}

	public function inventory_dashboard_retrieve_top_selling_products($method, $id, $request)
	{
		$filter = function($query){

						$query->whereHas('cashier', function($query){

							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
					};
		$items = (new InventoryTableItem)
				->select('*', DB::raw('(item_quantity - item_min_quantity) as item_min_qty'))
				->whereHas('itemQuantity', $filter)
				->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
			            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
			            $query->whereHas('cashier', function($query){
							
							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
			        }
		    	])->get();

		$products = collect($items)->filter(function($value, $key){
			return $value['item_quantity'] - $value['item_quantity_sold'] > 0;
		})->sortByDesc('item_quantity_sold')->take(10);

		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_products_below_minimum_level($method, $id, $request)
	{
		$filter = function($query){

						$query->whereHas('cashier', function($query){

							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
					};

		$items = (new InventoryTableItem)
				->select('*', DB::raw('(item_quantity - item_min_quantity) as item_min_qty'))
				->whereHas('itemQuantity', $filter)
				->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
			            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
			            $query->whereHas('cashier', function($query){
							
							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
			        }
		    	])->get();

		$products = collect($items)->filter(function($value, $key) {
			return $value['item_quantity_sold'] >= $value['item_min_qty'] && ($value['item_quantity'] - $value['item_quantity_sold']) > 0;
		})->take(10);

		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_products_with_expiry_date($method, $id, $request)
	{
		$products = (new InventoryTableItem)->whereNotNull('item_expiry_date')->orderBy('item_expiry_date','desc')->take(10)->get();

		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_out_of_stock_products($method, $id, $request)
	{
		$filter = function($query){
						$query->whereHas('cashier', function($query){

							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
					};

		$items = (new InventoryTableItem)
				->select('*', DB::raw('(item_quantity - item_min_quantity) as item_min_qty'))
				->whereHas('itemQuantity', $filter)
				->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
			            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
			            $query->whereHas('cashier', function($query){
							
							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhere('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						});
			        }
		    	])->get();

		$products = collect($items)->filter(function($value, $key) {
			return ($value['item_quantity_sold'] - $value['item_quantity']) == 0;
		})->take(10);
		
		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_recently_added_products($method, $id, $request)
	{
		$items = (new InventoryTableItem)
						->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
					            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
					            $query->whereHas('cashier', function($query){
									
									$query->where('cashier_purchase_type','purchase');
									$query->where('cashier_status_order','paid');

									$query->orWhere('cashier_purchase_type','order');
									$query->where('cashier_status_order','paid');

								});
					        }
				    	])->get();

		$products = collect($items)->filter(function($value, $key) {

			return $value['item_quantity_sold'] == 0;

		})->sortByDesc('created_date')->sortBy('item_description')->take(10);

		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_non_moving_products($method, $id, $request)
	{
		$items = (new InventoryTableItem)
						->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
					            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
					            $query->whereHas('cashier', function($query){
									
									$query->where('cashier_purchase_type','purchase');
									$query->where('cashier_status_order','paid');

									$query->orWhere('cashier_purchase_type','order');
									$query->where('cashier_status_order','paid');

								});
					        }
				    	]);

		if(request()->has('as_of_date')) {
			$items = $items->whereDate('item_purchase_date', '<=', request()->get('as_of_date'));
		} else {
			$items = $items->whereDate('item_purchase_date', '=', date('Y-m-d'));
		}

		$items = $items->get();

		$products = collect($items)->filter(function($value, $key) {

			return $value['item_quantity_sold'] == null;

		})->sortBy('item_description')->sortBy('item_purchase_date')->take(10);

		return $this->myViewMethodLoader($method)->with('products', $products);
	}

	public function inventory_dashboard_retrieve_top_customers($method, $id, $request)
	{
		$customers = (new InventoryTableCustomer)
							->whereHas('customerCashier')
							->withCount(['customerCashier as total_cost' => function($query){

								$query->select(DB::raw("SUM(cashier_total_amt) as total_cost"));

								$query->where('cashier_purchase_type','purchase');
								$query->where('cashier_status_order','paid');

								$query->orWhere('cashier_purchase_type','order');
								$query->where('cashier_status_order','paid');

							}])->with(['customerCashier' => function($query){

								$query->where('cashier_purchase_type','purchase');
								$query->where('cashier_status_order','paid');

								$query->orWhere('cashier_purchase_type','order');
								$query->where('cashier_status_order','paid');

								$query->withCount(['cashierDetails as total_quantity' => function($query){
									$query->select(DB::raw("SUM(cashier_quantity) as total_quantity"));
								}]);

							}])->get(10);

		$filter_customers = collect($customers)->sortByDesc('total_cost')->take(10);

		return $this->myViewMethodLoader($method)->with('customers', $filter_customers);
	}

	public function inventory_dashboard_retrieve_recent_customers($method, $id, $request)
	{
		$cashiers = (new InventoryActivityCashier)
							->whereHas('cashierCustomer')
							->withCount(['cashierDetails as total_quantity' => function($query){
								$query->select(DB::raw("SUM(cashier_quantity) as total_quantity"));
							}])
							->withCount(['cashierDetails as total_cost' => function($query){
								$query->select(DB::raw("SUM(cashier_selling_price) as total_cost"));
							}])
							->where('cashier_purchase_type','purchase')
							->where('cashier_status_order','paid')
							->orWhere('cashier_purchase_type','order')
							->where('cashier_status_order','paid')
							->get();

		$filter_cashiers = collect($cashiers)->sortByDesc('cashier_date')->take(10);

		return $this->myViewMethodLoader($method)->with('cashiers', $filter_cashiers);
	}

	public function inventory_dashboard_retrieve_customer_details($method, $id, $request)
	{
		$customer = (new InventoryTableCustomer)->with('customerContact')->with('customerAddress')->find(decrypt($request->get('id')));

		return $this->myViewMethodLoader($method)->with('customer', $customer);
	}

	public function inventory_dashboard_retrieve_customer_cashier_headers($method, $id, $request)
	{
		$cashier = (new InventoryActivityCashier)->where('cashier_id', decrypt($request->get('id')))->first();

		return $this->myViewMethodLoader($method)->with('cashier', $cashier);
	}
}