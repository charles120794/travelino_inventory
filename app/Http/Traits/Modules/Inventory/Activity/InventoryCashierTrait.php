<?php

namespace App\Http\Traits\Modules\Inventory\Activity;

use DB;

use App\Http\Controllers\Common\CommonServiceController as CommenService;

use App\Model\Inventory\activity\InventoryActivityBasket;
use App\Model\Inventory\activity\InventoryActivityCashier;
use App\Model\Inventory\activity\InventoryActivityCashierDetails;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;

trait InventoryCashierTrait
{

	public function inventory_cashier_create_receipt($method, $id, $request)
	{
		// return $request->all();

		$cashier_total_vat     = 0;
		$cashier_total_vatable = 0;
		$cashier_total_price   = 0;
		$cashier_total_qty     = 0;
	
		foreach ($request->item as $key => $value) {

			/* Check if Item Exists */
			$baskets = InventoryActivityBasket::with('itemCode')->where('basket_id', decrypt($value['basket_id']))->first();

			if(collect($baskets)->isNotEmpty()) {
				// if( ($baskets['item_quantity'] - $value['item_quantity_sold']) - $value['item_quantity'])
				/* GET THE ORIGINAL ITEM SELLING PRICE */
				if($baskets->itemCode['item_vat_type'] == 'vatable') {
					$cashier_total_vat     += (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) / 1.12) * CommenService::TAX_RATE; 
					$cashier_total_vatable += (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) / 1.12); 
				}

				if($baskets->itemCode['item_vat_type'] == 'exclusive') {
					$cashier_total_vat     += (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) * CommenService::TAX_RATE); 
					$cashier_total_vatable += (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new'])); 
				}

				$cashier_total_price += $baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']; 
				$cashier_total_qty   += $baskets['basket_item_quantity_new']; 

			} else {
				return abort(403, 'Something went wrong, Please try again');
			}

		}

		$check_amount = $cashier_total_price > str_replace(',', '', $request->input('total_cash'));
		$check_change = str_replace(',', '', $request->input('total_cash')) - $cashier_total_price != str_replace(',', '', $request->input('total_change'));

		if( $check_amount || $check_change ) {
			return abort(403, 'Something went wrong, Please try again');
		}

		$cashier_id = (new InventoryActivityCashier)->insertGetId([
			'cashier_code'          => $request->input('issue_code'),
			'cashier_date'          => $request->input('issue_date'),
			'cashier_particulars'   => $request->input('issue_particulars'),
			'cashier_customer_id'   => decrypt($request->input('customer_id')),
			'cashier_customer_name' => $request->input('customer_description'),
			'cashier_total_quantity'=> $cashier_total_qty,
			'cashier_total_price'   => $cashier_total_price,
			'cashier_total_vat'     => $cashier_total_vat,
			'cashier_total_vatable' => $cashier_total_vatable,
			'cashier_total_cash'    => str_replace(',', '', $request->input('total_cash')),
			'cashier_total_changed' => str_replace(',', '', $request->input('total_change')),
			'cashier_status_order'  => 'paid',
			'cashier_payment_date'  => (new CommenService)->dateTimeToday('Y-m-d'),
			'created_by'            => $this->thisUser()->users_id,
			'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
			'order_level'           => (new CommenService)->orderLevel(new InventoryActivityCashier),
		]);

		if($cashier_id > 0) {

			foreach ($request->item as $key => $value) {
				/* Check if Item Exists */
				$baskets = InventoryActivityBasket::with('itemCode')->where('basket_id', decrypt($value['basket_id']))->first();

				if(collect($baskets)->isNotEmpty()) {

						$cashier_vat_amt     = 0;
						$cashier_vatable_amt = 0;
						$cashier_price_amt   = $baskets->itemCode['item_purchase_price'] * $baskets['basket_item_quantity_new']; 
						$cashier_selli_amt   = $baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']; 

					if($baskets->itemCode['item_vat_type'] == 'vatable') {
						$cashier_vat_amt     = (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) / 1.12) * CommenService::TAX_RATE; 
						$cashier_vatable_amt = (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) / 1.12); 
					}

					if($baskets->itemCode['item_vat_type'] == 'exclusive') {
						$cashier_vat_amt     = (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new']) * CommenService::TAX_RATE); 
						$cashier_vatable_amt = (($baskets->itemCode['item_selling_price'] * $baskets['basket_item_quantity_new'])); 
					}

					(new InventoryActivityCashierDetails)->insert([
						'cashier_id'               => $cashier_id,
						'cashier_code'             => $request->input('issue_code'),
						'cashier_item'             => $baskets['basket_item_id'],
						'cashier_item_description' => $baskets['basket_item_description'],
						'cashier_item_code'        => $baskets['basket_item_code'],
						'cashier_unit'             => $baskets['basket_item_unit_description'],
						'cashier_unit_id'          => $baskets['basket_item_unit_id'],
						'cashier_quantity'         => $baskets['basket_item_quantity_new'],

						'cashier_purchase_price'   => $cashier_price_amt,
						'cashier_selling_price'    => $cashier_selli_amt,
						'cashier_vat_amount'       => $cashier_total_vat,
						'cashier_vatable_amt'      => $cashier_total_vatable,
						'cashier_gross_amt'        => $cashier_price_amt,
					]);

					/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
					$request->request->add(['basket_id' => $value['basket_id']]);

					$this->inventory_delete_customer_basket($method, $id, $request);
				
				} else {
					return abort(403, 'Something went wrong, Please try again');
				}
			}

			request()->session()->flash('success','Transaction successfully saved.');
			
			return redirect()->route('inventory.route',['path' => active_path(), 'action' => 'inventory-retrieve-customer-cashier-receipt', 'id' => encrypt($cashier_id)]);

		} else {
			return abort(403, 'Invalid Transaction');
		}
	}

	public function inventory_cashier_retrieve_receipt_history($method, $id, $request)
	{
		$cashiers = (new InventoryActivityCashier);

		$cashiers = $cashiers->whereIn('cashier_purchase_type', ['purchase','order'])->where('cashier_status_order','paid');

		if(request()->has('cashier-history-page')) {
			$cashiers = $cashiers->paginate(10, ['*'], 'cashier-history-page', request()->get('cashier-history-page'));
		} else {
			$cashiers = $cashiers->paginate(10, ['*'], 'cashier-history-page', 1);
		}

		return $this->myViewMethodLoader($method)->with('cashiers', $cashiers);
	}

	public function inventory_cashier_retrieve_product($method, $id, $request)
	{
		$search   = $request->get('search');

		$products = $this->inventory_retrieve_selling_product();

		$item_products = collect($products)->filter(function($value, $key) {
		    return ($value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout']) > 0 ;
		});
		
		return $this->myViewMethodLoader($method)
					->with('products', $this->CustomPaginate($item_products))
					->with('search', $search);
	}

	public function inventory_cashier_retrieve_product_json()
	{
		$products = $this->inventory_retrieve_selling_product();

		$filtered = collect($products)->filter(function($value, $key) {
		    return ($value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout']) > 0 ;
		})->map(function($value, $key){
			return collect($value)->merge(['item_id_encrypt' => encrypt($value->item_id)]);
		});

		return collect($filtered)->take(10)->values();
	}

	public function inventory_cashier_details()
	{
		return (new InventoryActivityCashierDetails)
					->with('cashier')
					->whereHas('cashier', function($query){

						$query = $query->where('cashier_status_order', 'paid');
						
						if(request()->has('df') && request()->has('dt')) {

							$query = $query->whereDate('cashier_date' , '>=', request()->get('df'));
							$query = $query->whereDate('cashier_date' , '<=', request()->get('dt'));

						} else {

							$query = $query->whereDate('cashier_date' , '=', date('Y-m-d'));
						}

					})->get();
	}
	
}