<?php

namespace App\Http\Traits\Inventory\Activity;

use DB;
use Session;
use App\Model\Inventory\activity\InventoryActivityBasket;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;

use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryBasketTrait
{

	public function inventory_create_customer_basket($method, $id, $request)
	{

		$basket = (new InventoryActivityBasket)
						->where('basket_item_id', decrypt($request->get('cashier_item_id')))
						->where('basket_customer_id', decrypt($request->get('cashier_item_customer')))
						->first();

		$items = (new InventoryTableItem)->where('item_id', decrypt($request->get('cashier_item_id')))
						->select('item_id','item_code','item_description','item_quantity','item_unit','item_selling_price','item_id')
						->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
					            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
					            $query->whereHas('cashier', function($query){
					            	$query->where('cashier_status_order', 'paid');
					            	$query->whereIn('cashier_purchase_type', ['purchase','order']);
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
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->where('basket_customer_id', decrypt($request->get('cashier_item_customer')))
					->update($collect);
			}

		} else {
			
			if(count($items) > 0) {
				/* CHECK IF THIS ITEM QUANTITY IS NOT ZERO */
				if(($items['item_quantity'] - $items['item_quantity_sold']) != 0) {
					(new InventoryActivityBasket)->insert([
						'basket_customer_id'           => decrypt($request->get('cashier_item_customer')),
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
	}

	public function inventory_retrieve_customer_basket($method, $id, $request)
	{
		$customer_basket = (new InventoryActivityBasket)->where('basket_customer_id', decrypt($request->get('cashier_item_customer')))->get();

		return $this->myViewMethodLoader($method)->with('customer_basket', $customer_basket);
	}

	public function inventory_update_customer_basket_quantity($method, $id, $request)
	{
		$basket_item = (new InventoryActivityBasket)
					->where('basket_item_id', decrypt($request->get('cashier_item_id')))
					->where('basket_customer_id', decrypt($request->get('cashier_item_customer')));

		if(collect($basket_item->first())->isNotEmpty()) {

			$product = InventoryTableItem::findOrFail(decrypt($request->cashier_item_id));

			$basket_item->update([
				'basket_item_price_new'    => $product['item_selling_price'] * $request->get('cashier_item_quantity'),
				'basket_item_quantity_new' => $request->get('cashier_item_quantity')
			]);
		}
	}

	public function inventory_delete_customer_basket($method, $id, $request)
	{
		return (new InventoryActivityBasket)->where('basket_id', decrypt($request->get('basket_id')))->delete();
	}

	public function customer_basket_data_delete($customer)
	{
		return (new InventoryActivityBasket)->where('basket_customer_id', $customer)->delete(); // Delete All Item From Basket
	}
}