<?php

namespace App\Http\Traits\Inventory\Activity;

use DB;
use App\Model\Inventory\Activity\InventoryActivityCashier;
use App\Model\Inventory\Activity\InventoryActivityCashierDetails;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryCashierTrait
{

	public function inventory_cashier_create_receipt($method, $id, $request)
	{
		$cashier_total_price   = 0;
		$cashier_total_vat     = 0;
		$cashier_total_vatable = 0;

		foreach ($request->item as $key => $value) {

			/* Check if Item Exists */
			$items = collect($this->inventory_retrieve_selling_product())->where('item_id', decrypt($value['item_id']))->first();

			if(collect($items)->isNotEmpty()) {

				if(($items['item_quantity'] - $items['item_quantity_sold']) - $value['item_quantity'] > 1) {

					// if( ($items['item_quantity'] - $value['item_quantity_sold']) - $value['item_quantity'])
					/* GET THE ORIGINAL ITEM SELLING PRICE */
					$cashier_total_price   += $items['item_selling_price'] * $value['item_quantity']; 

					if($items['item_vat_type'] == 'vatable') {
						$cashier_total_vat     += (($items['item_selling_price'] * $value['item_quantity']) / 1.12) * CommenService::TAX_RATE; 
						$cashier_total_vatable += (($items['item_selling_price'] * $value['item_quantity']) / 1.12); 
					}

					if($items['item_vat_type'] == 'exclusive') {
						$cashier_total_vat     += (($items['item_selling_price'] * $value['item_quantity']) * CommenService::TAX_RATE); 
						$cashier_total_vatable += (($items['item_selling_price'] * $value['item_quantity'])); 
					}

				} else {

					return abort(403, 'Something went wrong, Please try again');
				}
				
			} else {
				
				return abort(403, 'Something went wrong, Please try again');
			}

		}

		$cashier_id = (new InventoryActivityCashier)->insertGetId([
			'cashier_code'          => $request->input('issue_code'),
			'cashier_customer_id'   => $request->input('customer_id'),
			'cashier_customer_name' => $request->input('customer_description'),
			'cashier_date'          => $request->input('issue_date'),
			'cashier_particulars'   => $request->input('issue_particulars'),
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
				$items = collect($this->inventory_retrieve_selling_product())->where('item_id', decrypt($value['item_id']))->first();

				if(collect($items)->isNotEmpty()) {

					if(($items['item_quantity'] - $items['item_quantity_sold']) - $value['item_quantity'] > 1) {

						$cashier_vat_amt           = 0;
						$cashier_vatable_amt       = 0;
						$cashier_price_amt         = $items['item_purchase_price'] * $value['item_quantity']; 
						$cashier_selli_amt         = $items['item_selling_price'] * $value['item_quantity']; 

						if($items['item_vat_type'] == 'vatable') {
							$cashier_total_vat     = (($items['item_selling_price'] * $value['item_quantity']) / 1.12) * CommenService::TAX_RATE; 
							$cashier_total_vatable = (($items['item_selling_price'] * $value['item_quantity']) / 1.12); 
						}

						if($items['item_vat_type'] == 'exclusive') {
							$cashier_total_vat     = (($items['item_selling_price'] * $value['item_quantity']) * CommenService::TAX_RATE); 
							$cashier_total_vatable = (($items['item_selling_price'] * $value['item_quantity'])); 
						}

						(new InventoryActivityCashierDetails)->insert([
							'cashier_id'               => $cashier_id,
							'cashier_code'             => $request->input('issue_code'),
							'cashier_item'             => decrypt($value['item_id']),
							'cashier_item_description' => $value['item_description'],
							'cashier_item_code'        => $value['item_code'],
							'cashier_unit'             => $value['item_unit'],
							'cashier_unit_id'          => decrypt($value['item_unit_id']),
							'cashier_quantity'         => $value['item_quantity'],

							'cashier_purchase_price'   => $cashier_price_amt,
							'cashier_selling_price'    => $cashier_selli_amt,
							'cashier_vat_amount'       => $cashier_total_vat,
							'cashier_vatable_amt'      => $cashier_total_vatable,
							'cashier_gross_amt'        => $cashier_price_amt,
						]);

						/* REMOVE CUSTOMER BASKET ON SUCCESS CREATION OF RECEIPT */
						$request->request->add(['cashier_item_customer' => $request->input('customer_id')]);
						$request->request->add(['cashier_item_id' => $value['item_id']]);

						$this->inventory_delete_customer_basket($request);

					} else {

						return abort(403, 'Something went wrong, Please try again');
					}
				}
			}

			request()->session()->flash('success','Transaction successfully saved.');
			
			return back();

		} else {

			return abort(403, 'Invalid Transaction');
		}
	}

	public function inventory_cashier_retrieve_receipt_history($method, $id, $request)
	{
		$cashiers = (new InventoryActivityCashier);

		$cashiers = $cashiers->whereIn('cashier_purchase_type',['purchase','order'])->where('cashier_status_order','paid');

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