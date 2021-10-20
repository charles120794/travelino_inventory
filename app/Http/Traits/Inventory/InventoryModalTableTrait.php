<?php

namespace App\Http\Traits\Inventory;

use DB;
use Storage;
use Cache;
use Session;
use Yajra\Datatables\Datatables;
use Yajra\DataTables\CollectionDataTable;
use App\Model\Inventory\maintenance\InventoryTableItem;

trait InventoryModalTableTrait
{

	/* Retrieve all Seeling product to Cashier */
	public function inventory_retrieve_product_modal_table($method, $id, $request) 
	{

	    $products = (new InventoryTableItem)->query();

	    $products->with(['itemQuantity','itemBasket']);

	    $products->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
	            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
	            $query->whereHas('cashier', function($query){
	            	$query->where('cashier_status_order','paid');
	            	$query->whereIn('cashier_purchase_type', ['purchase','order']);
				});
	        }
    	]);

    	$products->withCount(['itemBasket AS item_quantity_basket' => function ($query) {
    			$query->select(DB::raw("SUM(basket_item_quantity_new)"));
	        }
    	]);

    	$products->havingRaw('
			item_quantity - 
			(CASE WHEN item_quantity_sold IS NOT NULL THEN item_quantity_sold ELSE 0 END) - 
			(CASE WHEN item_quantity_basket IS NOT NULL THEN item_quantity_basket ELSE 0 END) > 0
		');


    	// $new_products = collect($products->get())->filter(function($item){
    	// 	return $item['item_quantity_remaining'] > 0;
    	// });

		$content =  (new Datatables)->eloquent($products)

				->addColumn('item_quantity_remaining', function($query) {

					$item_quantity_sold = collect($query->itemQuantity)->filter(function($cashier){
						return $cashier->cashier['cashier_status_order'] == 'paid';
					})->sum('cashier_quantity');

				 	$item_quantity_bask = $query->itemBasket()->sum('basket_item_quantity_new');

					$total_quantity = $query['item_quantity'] - $item_quantity_sold - $item_quantity_bask;

					return $total_quantity;
				})
				
				->addColumn('quantity_button', function ($query) {

					$item_quantity_sold = collect($query->itemQuantity)->filter(function($cashier){
						return $cashier->cashier['cashier_status_order'] == 'paid';
					})->sum('cashier_quantity');

				 	$item_quantity_bask = $query->itemBasket()->sum('basket_item_quantity_new');

					$total_quantity = $query['item_quantity'] - $item_quantity_sold - $item_quantity_bask;

	                return '<div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-les-qty modal-btn-les-qty' . $query['item_id'] . '" data-key="' . $query['item_id'] . '" disabled>
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                                <input type="text" class="form-control text-center input-number input-quantity no-padding input-sm modal-item-qty modal-item-qty' . $query['item_id'] . '" data-key="' . $query['item_id'] . '" style="min-width: 50px;" value="1">

                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-add-qty modal-btn-add-qty' . $query['item_id'] . '" data-key="' . $query['item_id'] . '">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div> <input type="hidden" id="item_max_qty' . $query['item_id'] . '" value="' . $total_quantity . '"> ';
            	})

            	->addColumn('selected_product', function($query){
            		return '<a href="' . encrypt($query['item_id']) . '" class="btn btn-primary btn-sm btn-flat selected-product" data-key="' . $query['item_id'] . '"> Select </a>';
            	})

            	->rawColumns(['quantity_button','selected_product'])
         
            	->toJson();

        return $content;

        // Storage::put('products.txt', $content);
	}

	public function inventory_retrieve_customer_modal_table($method, $id, $request) 
	{
		$customers = collect($this->inventory_retrieve_customer())->map(function($item){
			return collect($item->only([
				'customer_id',
				'customer_code',
				'customer_description'
			]))->merge([
				'contact_number' => $item->customerContact['contact_number'],
				'contact_email'  => $item->customerContact['contact_email'],
			]);
		})->chunk(20);

		return view($method['method_blade'], ['customers' => $customers]);
	}

}