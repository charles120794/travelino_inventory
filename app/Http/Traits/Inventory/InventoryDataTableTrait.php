<?php

namespace App\Http\Traits\Inventory;

use DB;
use Storage;
use Cache;
use Session;
use Yajra\Datatables\Datatables;
use Yajra\DataTables\CollectionDataTable;

use App\Model\Inventory\activity\InventoryActivityCashier;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;

trait InventoryDataTableTrait
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

		$contents = (new Datatables)->eloquent($products)

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
            		return '<button type="button" class="btn btn-primary btn-sm btn-flat selected-product" data-item="' . encrypt($query['item_id']) . '" data-key="' . $query['item_id'] . '"> Select </button>';
            	})

            	->rawColumns(['quantity_button','selected_product'])
         
            	->toJson();

        return $contents;
	}

	public function inventory_retrieve_customer_modal_table($method, $id, $request) 
	{
		$customers = InventoryTableCustomer::query();

		$customers->with(['customerContact']);

		$customers->select('customer_id','customer_code','customer_description','customer_contact');

		$contents = (new Datatables)->eloquent($customers)

					->addColumn('customer_phone_no', function($query){
						return $query->customerContact['contact_number'];
					})

					->addColumn('customer_email', function($query){
						return $query->customerContact['contact_email'];
					})

					->addColumn('action', function($query){
						return '<button class="btn btn-primary btn-flat btn-sm btn-block btn-selected-customer" 
									data-customer="' . encrypt($query['customer_id']) . '">Select</button>';
					})

					->filter(function ($query) {
	                    if (request()->has('search')) {
	                        $query->where('customer_code', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhere('customer_description', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhereHas('customerContact', function($query){
	                        	$query->where('contact_number','like', "%" . request()->search['value'] . "%");
	                        });
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhereHas('customerContact', function($query){
	                        	$query->where('contact_email','like', "%" . request()->search['value'] . "%");
	                        });
	                    }
	                })

					->toJson();

		return $contents;
	}

	public function inventory_retrieve_cashier_receipt_history_modal_table($method, $id, $request)
	{
		$cashier = InventoryActivityCashier::query();

		$cashier->select('cashier_id','cashier_customer_name','cashier_date','cashier_total_price');

		$cashier->where('cashier_purchase_type','purchase')->where('cashier_status_order','paid');

		$contents = (new Datatables)->eloquent($cashier)

					->addColumn('customer_name', function($query){
						return $query->cashier_customer_name;
					})

					->addColumn('customer_date_purchased', function($query){
						return date('F d, Y', strtotime($query->cashier_date));
					})

					->addColumn('customer_total_purchase', function($query){
						return '&#8369; ' . number_format($query->cashier_total_price, 2);
					})

					->addColumn('action', function($query){

						$location = route('inventory.route', ['path' => active_path(), 'action' => 'inventory-retrieve-customer-receipt', 'id' => encrypt($query['cashier_id'])]);

						return '<a href="' . $location . '" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Print Receipt </a>';
					})

					->filter(function ($query) {
	                    if (request()->has('search')) {
	                        $query->orWhere('cashier_customer_name', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhere('cashier_date', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhere('cashier_total_price', 'like', "%" . request()->search['value'] . "%");
	                    }
	                })

	                ->order(function ($query) {
						if (request()->order[0]['column'] == 0) {
						    $query->orderBy('cashier_customer_name', request()->order[0]['dir']);
						}

	                    if (request()->order[0]['column'] == 1) {
	                        $query->orderBy('cashier_date', request()->order[0]['dir']);
	                    }

	                    if (request()->order[0]['column'] == 2) {
	                        $query->orderBy('cashier_total_price', request()->order[0]['dir']);
	                    }
	                })

	                ->rawColumns(['customer_total_purchase','action'])

					->toJson();

		return $contents;
	}

	public function inventory_retrieve_order_receipt_history_modal_table($method, $id, $request)
	{

		$contents = (new Datatables)->eloquent(InventoryActivityCashier::query())

					->addColumn('customer_name', function($query){
						return $query->cashier_customer_name;
					})

					->addColumn('customer_status', function($query){
						return ucfirst($query->cashier_status);
					})

					->addColumn('customer_date_purchased', function($query){
						return date('F d, Y', strtotime($query->cashier_date));
					})

					->addColumn('customer_date_payment', function($query){
						return date('F d, Y', strtotime($query->cashier_payment_date));
					})

					->addColumn('customer_total_purchase', function($query){
						return '&#8369; ' . number_format($query->cashier_total_price, 2);
					})

					->addColumn('customer_pending_action', function($query){

						$edit_location = route('inventory.route', ['path' => active_path(), 'action' => 'inventory-edit-order', 'id' => encrypt($query['cashier_id'])]);
						$cancel_location = route('inventory.route', ['path' => active_path(), 'action' => 'inventory-cancel-order', 'id' => encrypt($query['cashier_id'])]);

						return '<a href="' . $edit_location . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit </a>
								<a href="' . $cancel_location . '" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Cancel </a>';
					})

					->addColumn('customer_history_action', function($query){

						$location = route('inventory.route', ['path' => active_path(), 'action' => 'inventory-retrieve-order-receipt', 'id' => encrypt($query['cashier_id'])]);

						return '<a href="' . $location . '" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Print Receipt </a>';
					})

					->filter(function ($query) {
						
						if(request()->order_type == 'history') {
							$query->where('cashier_purchase_type','order')->whereIn('cashier_status', ['posted','cancelled']);;
						}

						if(request()->order_type == 'pending') {
							$query->where('cashier_purchase_type','order')->where('cashier_status','new');
						}
						
	                    if (!is_null( request()->search['value'] )) {
	                        $query->orWhere('cashier_customer_name', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (!is_null( request()->search['value'] )) {
	                        $query->orWhere('cashier_date', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (!is_null( request()->search['value'] )) {
	                        $query->orWhere('cashier_total_price', 'like', "%" . request()->search['value'] . "%");
	                    }
	                })

	                ->order(function ($query) {
						if (request()->order[0]['column'] == 0) {
						    $query->orderBy('cashier_customer_name', request()->order[0]['dir']);
						}

	                    if (request()->order[0]['column'] == 1) {
	                        $query->orderBy('cashier_date', request()->order[0]['dir']);
	                    }

	                    if (request()->order[0]['column'] == 2) {
	                        $query->orderBy('cashier_total_price', request()->order[0]['dir']);
	                    }
	                })

	                ->rawColumns(['customer_total_purchase','customer_pending_action','customer_history_action'])

					->toJson();

		return $contents;
	}

	public function inventory_retrieve_products_data($method, $id, $request)
	{
		$products = InventoryTableItem::query();

		$products->select('item_id','item_image','item_description','item_quantity','item_purchase_price','item_selling_price');

		$contents = (new Datatables)->eloquent($products)

					->addColumn('item_image_path', function($query){
						return '<img src="' . Storage::url($query->item_image) . '" style="width: 100px;">';
					})

					->addColumn('item_quantity_remaining_table', function($query){

				    	$baskets = $query->itemBasket();
				    	$cashier = $query->itemQuantity();

				        $cashier->whereHas('cashier', function($query){
				        	$query->where('cashier_status_order','paid');
				        	$query->whereIn('cashier_purchase_type', ['purchase','order']);
						});

				    	return $query->item_quantity - $cashier->sum('cashier_quantity') - $baskets->sum('basket_item_quantity_new');
					})

					->addColumn('item_purchase_price', function($query){
						return number_format($query->item_purchase_price, 2);
					})

					->addColumn('item_selling_price', function($query){
						return number_format($query->item_selling_price, 2);
					})

					->addColumn('action', function($query){

						return '<button class="btn btn-info btn-flat btn-modal-view" data-id="' . encrypt($query->item_id) . '"><i class="fa fa-eye"></i></button>
								<button class="btn btn-primary btn-flat btn-modal-edit" data-id="' . encrypt($query->item_id) . '"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-flat" onclick="return confirm(\'Are you sure you want to delete this item?\')"><i class="fa fa-trash"></i></button>';
					})

					->filter(function ($query) {
	                    if (request()->has('search')) {
	                        $query->orWhere('item_description', 'like', "%" . request()->search['value'] . "%");
	                    }
	                })

	                ->order(function ($query) {
	                	if (request()->order[0]['column'] == 0) {
	                	    $query->orderBy('item_image', request()->order[0]['dir']);
	                	}

						if (request()->order[0]['column'] == 1) {
						    $query->orderBy('item_description', request()->order[0]['dir']);
						}

	                    if (request()->order[0]['column'] == 2) {
	                        $query->orderBy('item_quantity_remaining', request()->order[0]['dir']);
	                    }

	                    if (request()->order[0]['column'] == 3) {
	                        $query->orderBy('item_purchase_price', request()->order[0]['dir']);
	                    }

	                    if (request()->order[0]['column'] == 4) {
	                        $query->orderBy('item_selling_price', request()->order[0]['dir']);
	                    }
	                })

	                ->rawColumns(['item_image_path', 'action'])

					->toJson();

		return $contents;
	}

	public function inventory_retrieve_customers_data($method, $id, $request)
	{
		$customer = InventoryTableCustomer::query();

		$customer->with('customerContact','customerAddress');

		$customer->select('customer_id','customer_contact','customer_address','customer_code','customer_description');

		$contents = (new Datatables)->eloquent($customer)

					->addColumn('customer_email', function($query){
						return $query->customerContact['contact_email'];
					})

					->addColumn('customer_contact', function($query){
						return '<button class="btn btn-info btn-flat modal-show-contact" 
									data-person="' . $query->customerContact['contact_description'] . '"
									data-number="' . $query->customerContact['contact_number'] . '"
									data-email="' . $query->customerContact['contact_email'] . '"
									data-position="' . $query->customerContact['contact_position'] . '"
								><i class="fa fa-eye"></i></button>';
					})

					->addColumn('customer_address', function($query){
						return '<button class="btn btn-info btn-flat modal-show-address" 
									data-number="' . $query->customerAddress['address_number'] . '"
									data-street="' . $query->customerAddress['address_street'] . '"
									data-barangay="' . $query->customerAddress['address_barangay'] . '"
									data-city="' . $query->customerAddress['address_city'] . '"
									data-zip="' . $query->customerAddress['address_zip'] . '"
								><i class="fa fa-eye"></i></button>';
					})

					->addColumn('action', function($query){

						$location = route('inventory.route',['path' => active_path(), 'action' => 'delete-customer', 'id' => encrypt($query->customer_id)]);

				    	return '<button type="button" class="btn btn-primary btn-flat modal-edit-customer" data-id="' . $query->customer_id . '"><i class="fa fa-edit"></i></button>
                            <a href="' . $location . '" class="btn btn-danger btn-flat btn-del-validate"><i class="fa fa-trash"></i></a>';
					})

					->filter(function ($query) {
	                    if (request()->has('search')) {
	                        $query->where('customer_code', 'like', "%" . request()->search['value'] . "%");
	                        $query->orWhere('customer_description', 'like', "%" . request()->search['value'] . "%");
	                    }

	                    if (request()->has('search')) {
	                        $query->orWhereHas('customerContact', function($query){
	                        	$query->where('contact_email','like', "%" . request()->search['value'] . "%");
	                        });
	                    }
	                })

	                ->order(function ($query) {
	                	if (request()->order[0]['column'] == 0) {
	                	    $query->orderBy('customer_code', request()->order[0]['dir']);
	                	}

						if (request()->order[0]['column'] == 1) {
						    $query->orderBy('customer_description', request()->order[0]['dir']);
						}
	                })

	                ->rawColumns(['customer_contact', 'customer_address', 'action'])

					->toJson();

		return $contents;
	}

}