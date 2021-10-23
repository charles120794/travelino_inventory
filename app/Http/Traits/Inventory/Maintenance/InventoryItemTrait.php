<?php

namespace App\Http\Traits\Inventory\Maintenance;

use DB;
use Session;
use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableItemGroup;
use App\Model\Inventory\maintenance\InventoryTableItemImages;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryItemTrait
{

	public function inventory_retrieve_selling_product()
	{
		$items = (new InventoryTableItem)
					->with('itemBasket')
					->with('itemQuantity')
					->withCount(['itemQuantity AS item_quantity_sold' => function ($query) {
				            $query->select(DB::raw("SUM(cashier_quantity) as cashier_quantity"));
				            $query->whereHas('cashier', function($query){

				            	$query->where('cashier_status_order','paid');
				            	$query->whereIn('cashier_purchase_type', ['purchase','order']);
							});
				        }
			    	])
			    	->withCount(['itemBasket AS item_quantity_checkout' => function ($query) {
	    		            if(request()->has('customer')) {
	    		            	$query->select(DB::raw("SUM(basket_item_quantity_new) as basket_item_quantity"));
	    		            }
	    		        }
	    	    	]);

    	if(request()->has('search') && !is_null(request()->get('search'))) {
			$items = $items->where('item_code', 'like', '%' . request()->get('search') . '%');
			$items = $items->orWhere('item_description', 'like', '%' . request()->get('search') . '%');
		}

		return $items->orderBy('item_description','asc')->get();
	}

	public function foreachdataflatten($array = [], $result = [])
	{

		// $childGroup = InventoryTableItemGroup::where('group_id','34')->with('groupParent')->first()->toArray();
	
		$result[] = $array['group_description'];
		
		if(!is_null($array['group_parent'])) {

			if(array_key_exists('group_parent', $array)) {

				$flattend = $array['group_parent'];

				$result = array_merge($result,$this->foreachdataflatten($flattend));

			} 

		}

		return $result;

		/* To Dispplay as Catetory Type */
		/* Copy this code */
		// return implode(' / ', array_reverse($this->foreachdataflatten($childGroup)));
	}

	protected function product_data($page = null)
	{
		return (new InventoryTableItem)
					->with('itemGroup')
					->with('itemImages')
					->with('itemVariants')
					->with('itemUnit')
					->with('itemSupplier')
					->orderBy('item_id','asc')
					->paginate(10,['*'],'page',$page);
	}

	public function inventory_show_product_details($method, $id, $request)
	{
		$product = InventoryTableItem::where('item_id', decrypt($request->id))->first();

		abort_if(collect($product)->isEmpty(), 403, 'Product is not available');

		return $this->myViewMethodLoader($method)->with('product', $product);
	}

	public function inventory_create_item_page($method, $id, $request)
	{
		$units      = $this->unit_data();
		$supplier   = $this->supplier_data();
		$warehouse  = $this->warehouse_data();

		return $this->myViewMethodLoader($method, $this->product_group_data())
					->with('units', $units)
					->with('supplier_data', $supplier)
					->with('warehouse_data', $warehouse);
	}

	public function inventory_create_item($method, $id, $request)
	{

		$itemProductID = (new InventoryTableItem)->insertGetId([
			'item_group'            => $request->input('item_group'),
			'item_supplier'         => $request->input('item_supplier'),
			'item_warehouse'        => $request->input('item_warehouse'),
			'item_image'            => collect($request->media)->first()['product_image'],
			// $itemProduct->item_variant  = $request->input('item_variant');
			'item_unit'             => $request->input('item_unit'),
			'item_type'             => $request->input('item_type'),
			'item_code'             => $request->input('item_code'),
			'item_description'      => $request->input('item_description'),
			'item_long_description' => $request->input('item_long_description'),

			'item_purchase_price'   => str_replace(',', '', $request->input('total_purchase')),
			'item_selling_price'    => str_replace(',', '', $request->input('total_sales')),
			'item_quantity'         => str_replace(',', '', $request->input('total_quantity')),
			
			'item_min_quantity'     => $request->input('item_min_quantity'),
			'item_expiry_date'      => $request->input('item_expiry_date'),
			'item_purchase_date'    => $request->input('item_purchase_date'),
			'item_condition'        => $request->input('item_condition'),
			/* Credits */
			'created_by'            => $this->thisUser()->users_id,
			'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		if( $itemProductID ) {
			// $this->inventory_create_variant($method, $itemProductID, $request);
			$this->inventory_create_item_images($method, $itemProductID, $request);
		}

		$request->session()->flash('success','Product successfully created.');
		
		return back();
	}

	public function inventory_create_item_images($method, $id, $request)
	{
		foreach ($request->media as $key => $value) {
			if(!is_null($value['product_image'])) {
				(new InventoryTableItemImages)->insert([
					'image_item' => $id,
					'image_path' => $value['product_image'],
				]);
			}
		}
	}

}