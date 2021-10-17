<?php

namespace App\Http\Traits\Inventory\Activity;

use DB;
use Session;
use App\Model\Inventory\Activity\InventoryActivityCashier;
use App\Model\Inventory\Activity\InventoryActivityCashierDetails;
use App\Model\Inventory\Activity\InventoryActivityBasket;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryOrderTrait
{

	public function inventory_order_retrieve_history($method, $id, $request)
	{
		$orders = (new InventoryActivityCashier);

		$orders = $orders->where('cashier_purchase_type','order');

		$orders = $orders->paginate();

		return $this->myViewMethodLoader($method)->with('orders', $orders);
	}

	public function inventory_order_product($method, $id, $request)
	{
		$search   = $request->get('search');

		$products = $this->order_product_data();

		$item_products = collect($products)->filter(function($value, $key) {
		    return ($value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout']) > 0 ;
		});

		return $this->myViewMethodLoader($method)
					->with('products', $this->CustomPaginate($item_products))
					->with('search', $search);
	}

	public function inventory_order_product_json()
	{
		$products = $this->order_product_data();

		$filtered = collect($products)->filter(function($value, $key) {
		    return ($value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout']) > 0 ;
		});

		return collect($filtered)->take(10)->values(); 
	}

	public function inventory_order_create_receipt($method, $id, $request, $cashier_total_price = 0.00)
	{

		foreach ($request->item as $key => $item) {

			/* Check if Item Exists */
			$items = (new InventoryTableItem)->where('item_id', decrypt($value['item_id']))->first();

			if(collect($items)->isNotEmpty()) {

				$cashier_total_price += $items['item_selling_price'] * $value['item_quantity']; 

			} else {
				return abort(403, 'Something went wrong, Please try again');
			}
		}

		$cashier_id = (new InventoryActivityCashier)->insertGetId([
			'cashier_code'          => $request->input('order_code'),
			'cashier_customer_id'   => $request->input('customer_id'),
			'cashier_customer_name' => $request->input('customer_description'),
			'cashier_date'          => $request->input('order_date'),
			'cashier_particulars'   => $request->input('order_particulars'),
			'cashier_purchase_type' => 'order',
			'cashier_status_order'  => 'unpaid',
			'cashier_status'        => 'new',
			'cashier_payment_mode'  => $request->input('order_payment'),
			'cashier_due_date'      => $request->input('order_date'),
			'cashier_total_amt'     => $cashier_total_price,
			// 'cashier_total_cash'    => str_replace(',', '', $request->input('total_cash')),
			// 'cashier_total_changed' => str_replace(',', '', $request->input('total_change')),
			// 'cashier_payment_date'  => (new CommenService)->dateTimeToday('Y-m-d'),
			'created_by'            => $this->thisUser()->users_id,
			'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
			'order_level'           => (new CommenService)->orderLevel(new InventoryActivityCashier),
		]);

		foreach ($request->item as $key => $value) {
			/* Check if Item Exists */
			$items = (new InventoryTableItem)->where('item_id', decrypt($value['item_id']))->first();

			if(collect($items)->isNotEmpty()) {

				$total_profit = (($items['item_selling_price'] * $value['item_quantity']) - ($items['item_purchase_price'] * $value['item_quantity']));

				(new InventoryActivityCashierDetails)->insert([
					'cashier_id'               => $cashier_id,
					'cashier_code'             => $request->input('order_code'),
					'cashier_item'             => decrypt($value['item_id']),
					'cashier_item_description' => $value['item_description'],
					'cashier_item_code'        => $value['item_code'],
					'cashier_unit'             => $value['item_unit'],
					'cashier_unit_id'          => decrypt($value['item_unit_id']),
					'cashier_quantity'         => $value['item_quantity'],
					'cashier_purchase_price'   => $items['item_purchase_price'] * $value['item_quantity'], /* EXPENSE */
					'cashier_selling_price'    => $items['item_selling_price'] * $value['item_quantity'],  /* REVENUE - TOTAL SALES */
					'cashier_vat_amount'       => $items['item_vat_amount'] * $value['item_quantity'],     /* VAT PER ITEM */
					'cashier_profit_amt'       => $total_profit,										   /* PROFIT/INCOME TOTAL SALES LESS TOTAL EXPENSE  */
				]);
			}
		}

		/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
		$this->customer_basket_data_delete($request->input('customer_id'));

		$request->session()->flash('success','Order successfully created.');
		return back();
	}

	/* Customer Basket */
	public function inventory_order_create_baskets($method, $id, $request)
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

	public function inventory_order_retrieve_basket($method, $id, $request)
	{
		/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
		$this->customer_basket_data_delete($request->get('cashier_item_customer'));

		$customer_basket = $this->customer_basket_data($request->get('cashier_item_customer'));

		return $this->myViewMethodLoader($method)->with('customer_basket', $customer_basket);

	}

	public function inventory_order_update_customer_basket_quantity($method, $id, $request)
	{

		$basket_item = (new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->first();

		if(collect($basket_item)->isNotEmpty()) {

			(new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->update([
						'basket_item_price_new' => $basket_item['basket_item_price_old'] * $request->get('cashier_item_quantity'),
						'basket_item_quantity_new' => $request->get('cashier_item_quantity')
					]);

		}
	}

	public function inventory_order_delete_customer_basket($method, $id, $request)
	{
		(new InventoryActivityBasket)
					->where('basket_customer_id', $request->get('cashier_item_customer'))
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->delete();
	}

	/* Callable FUnction */
	protected function order_product_data()
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
	
}