<?php

namespace App\Http\Traits\Inventory\Activity;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

use DB;
use Session;
use App\Model\Inventory\Activity\InventoryActivityCashier;
use App\Model\Inventory\Activity\InventoryActivityCashierDetails;
use App\Model\Inventory\Activity\InventoryActivityBasket;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryCashierTrait
{
	public function json_collect_customer_by_id()
	{
		return $customers = (new InventoryTableCustomer)
								->select('customer_id as customer','customer_code','customer_description as customer_name')
								->where('customer_id', decrypt(request()->get('customer')))
								->first()->toJson();
	}

	public function inventory_cashier_customer($method = [], $id = '', $request = [])
	{
		$customers = (new InventoryTableCustomer)->orderBy('customer_description','asc');

		if(request()->has('search')) {

			$hasCustomer = function($query){
				$query = $query->Where('contact_number','like', '%' . request()->get('search') . '%');
				$query = $query->orWhere('contact_email','like', '%' . request()->get('search') . '%');
			};

			$customers = $customers->whereHas('customerContact', $hasCustomer);
			$customers = $customers->orWhere('customer_code','like', '%' . request()->get('search') . '%');
			$customers = $customers->orWhere('customer_description','like', '%' . request()->get('search') . '%');
		}

		if(request()->has('page')) {
			$customers = $customers->paginate(10,['*'],'page', request()->get('page'));
		}

		return $customers;
	}

	public function html_collect_customers()
	{
		return view('manage.inventory.activity.pagination.modalcustomerpage',[
			'customers' => $this->inventory_cashier_customer(),
			'search'    => request()->get('search'),
		]);
	}

	public function html_collect_customers_json()
	{
		return response()->json(['customers' => $this->inventory_cashier_customer()]);
	}

	public function cashier_product_data()
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
			    	])->withCount(['itemBasket AS item_quantity_checkout' => function ($query) {
	    		            if(request()->has('customer')) {
	    		            	$query->select(DB::raw("SUM(basket_item_quantity_new) as basket_item_quantity"));
	    		            }
	    		        }
	    	    	]);

    	if(request()->has('search') && !is_null(request()->get('search'))) {
			$items = $items->where('item_code','like', '%' . request()->get('search') . '%');
			$items = $items->orWhere('item_description','like', '%' . request()->get('search') . '%');
		}

		return $items->orderBy('item_description','asc')->get();
	}

	public function convert_item_to_json()
	{
		return $this->cashier_product_data();
	}

	public function inventory_cashier_product($method, $id, $request)
	{
		$search   = $request->get('search');
		$products = $this->cashier_product_data($request);

		$item_products = collect($products)->filter(function($value, $key) {
		    return ($value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout']) > 0 ;
		});
		
		$item_products_paginated = $this->paginate($item_products);

		return $this->myViewMethodLoader($method)->with('products', $item_products_paginated)->with('search', $search);
	}

	public function paginate($items, $perPage = 10, $page = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? $items : Collection::make($items);

		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
	}

	public function inventory_cashier_create_receipt($method, $id, $request, $cashier_total_amt = 0.00)
	{

		foreach ($request->item as $key => $item) {
			$cashier_total_amt += str_replace(',', '', $item['item_total_price']);
		}

		$cashier_id = (new InventoryActivityCashier)->insertGetId([
			'cashier_code'          => $request->input('issue_code'),
			'cashier_customer_id'   => $request->input('customer_id'),
			'cashier_customer_name' => $request->input('customer_description'),
			'cashier_date'          => $request->input('issue_date'),
			'cashier_particulars'   => $request->input('issue_particulars'),
			'cashier_total_amt'     => $cashier_total_amt,
			'cashier_total_cash'    => str_replace(',', '', $request->input('total_cash')),
			'cashier_total_changed' => str_replace(',', '', $request->input('total_change')),
			'cashier_status_order'  => 'paid',
			'cashier_payment_date'  => (new CommenService)->dateTimeToday('Y-m-d'),
			'created_by'            => $this->thisUser()->users_id,
			'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
			'order_level'           => (new CommenService)->orderLevel(new InventoryActivityCashier),
		]);

		foreach ($request->item as $key => $value) {
			/* Check if Item Exists */
			$items = (new InventoryTableItem)->where('item_id', decrypt($value['item_id']))->first();

			if(count($items) > 0) {

				$total_sales = (($items['item_selling_price'] * $value['item_quantity']) - ($items['item_purchase_price'] * $value['item_quantity']));

				(new InventoryActivityCashierDetails)->insert([
					'cashier_id'               => $cashier_id,
					'cashier_code'             => $request->input('issue_code'),
					'cashier_item'             => decrypt($value['item_id']),
					'cashier_item_description' => $value['item_description'],
					'cashier_item_code'        => $value['item_code'],
					'cashier_unit'             => $value['item_unit'],
					'cashier_unit_id'          => decrypt($value['item_unit_id']),
					'cashier_quantity'         => $value['item_quantity'],
					'cashier_purchase_price'   => $items['item_purchase_price'] * $value['item_quantity'],
					'cashier_selling_price'    => $items['item_selling_price'] * $value['item_quantity'],
					'cashier_total_amt'        => $total_sales,
				]);

			}

		}

		/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
		$this->customer_basket_data_delete($request->input('customer_id'));

		$request->session()->flash('success','Transaction successfully saved.');
		return back();
		
	}

	public function inventory_cashier_create_basket($method, $id, $request)
	{
		if($request->has('is_not_encrypted') && decrypt($request->get('is_not_encrypted')) == 'now_you_see_me') { 

			$cashier_item_id = $request->get('cashier_item_id');
			$cashier_item_customer = $request->get('cashier_item_customer');

		} else {

			$cashier_item_id = decrypt($request->get('cashier_item_id'));
			$cashier_item_customer = $request->get('cashier_item_customer');

		}

		$basket = (new InventoryActivityBasket)
						->where('basket_item_id', $cashier_item_id)
						->where('basket_customer_id', $cashier_item_customer)
						->first();

		$items = (new InventoryTableItem)->where('item_id', $cashier_item_id)
						->select('item_id','item_code','item_description','item_quantity','item_unit','item_selling_price','item_id')
						->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
					            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
					            $query->whereHas('cashier', function($query){

					            	$query->where('cashier_purchase_type','purchase');
					            	$query->where('cashier_status_order','paid');

					            	$query->orWhere('cashier_purchase_type','order');
					            	$query->where('cashier_status_order','paid');

								});
					        }
				    	])->first();

		if(count($basket) > 0) {
			/* IF ITEM PURCHASESING IS LESS THAN OR EQUAL TO ITEM QUANTITY REMAINING */
			if(($items['item_quantity'] - $items['item_quantity_sold']) >= ($basket['basket_item_quantity_new'] + $request->get('cashier_item_quantity'))) {

				$collect = [
					'basket_item_price_new'  => (($basket['basket_item_quantity_new'] + $request->get('cashier_item_quantity')) * $basket['basket_item_price_old']),
					'basket_item_quantity_new' => $basket['basket_item_quantity_new'] + $request->get('cashier_item_quantity'),
				];

				(new InventoryActivityBasket)
					->where('basket_item_id', $cashier_item_id)
					->where('basket_customer_id', $cashier_item_customer)
					->update($collect);

			}

		} else {
			
			if(count($items) > 0) {
				/* CHECK IF THIS ITEM QUANTITY IS NOT ZERO */
				if(($items['item_quantity'] - $items['item_quantity_sold']) != 0) {
					(new InventoryActivityBasket)->insert([
						'basket_customer_id'           => $cashier_item_customer,
						'basket_item_id'               => $items['item_id'],
						'basket_item_unit_id'          => $items['item_unit'],
						'basket_item_code'             => $items['item_code'],
						'basket_item_description'      => $items['item_description'],
						'basket_item_unit_description' => $items->itemUnit['unit_description'],
						'basket_item_price_old'        => $items['item_selling_price'],
						'basket_item_price_new'        => $items['item_selling_price'] * $request->get('cashier_item_quantity'),
						'basket_item_quantity_old'     => $items['item_quantity'] - $items['item_quantity_sold'],
						'basket_item_quantity_new'     => $request->get('cashier_item_quantity'),
						'basket_item_type'             => 'purchase',
					]);
				}
			}
		}

		return $this->myViewMethodLoader($method)->with('customer_basket', $this->customer_basket_data($cashier_item_customer));

	}

	public function inventory_cashier_retrieve_basket($method, $id, $request)
	{
		/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
		$this->customer_basket_data_delete($request->get('cashier_item_customer'));

		$customer_basket = $this->customer_basket_data($request->get('cashier_item_customer'));

		return $this->myViewMethodLoader($method)->with('customer_basket', $customer_basket);

	}

	public function inventory_cashier_update_basket_quantity($method, $id, $request)
	{

		$basket_item = (new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->first();

		if(count($basket_item) > 0) {

			(new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->update([
						'basket_item_price_new' => $basket_item['basket_item_price_old'] * $request->get('cashier_item_quantity'),
						'basket_item_quantity_new' => $request->get('cashier_item_quantity')
					]);

		}

	}

	public function inventory_cashier_delete_customer_basket($method, $id, $request)
	{
		(new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->delete();
	}

	public function inventory_cashier_total_expenses_price()
	{
		return $this->inventory_cashier_header()->sum('cashier_purchase_price');
	}

	public function inventory_cashier_total_revenue_price()
	{
		return $this->inventory_cashier_header()->sum('cashier_selling_price');
	}

	public function inventory_cashier_total_income_price()
	{
		return $this->inventory_cashier_header()->sum('cashier_total_amt');
	}

	public function inventory_cashier_total_quantity_sold()
	{
		return $this->inventory_cashier_header()->sum('cashier_quantity');
	}

	public function inventory_cashier_header()
	{
		return (new InventoryActivityCashierDetails)
					->with('cashier')
					->whereHas('cashier', function($query){
						
						if(request()->has('df') && request()->has('dt')) {

							$query->whereDate('cashier_date' , '>=', request()->get('df'));
							$query->whereDate('cashier_date' , '<=', request()->get('dt'));
							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhereDate('cashier_date' , '>=', request()->get('df'));
							$query->whereDate('cashier_date' , '<=', request()->get('dt'));
							$query->where('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						} else {

							$query->whereDate('cashier_date' , '=', date('Y-m-d'));
							$query->where('cashier_purchase_type','purchase');
							$query->where('cashier_status_order','paid');

							$query->orWhereDate('cashier_date' , '=', date('Y-m-d'));
							$query->where('cashier_purchase_type','order');
							$query->where('cashier_status_order','paid');

						}

					})->get();
	}
	
}