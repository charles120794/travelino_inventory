<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableItemGroup;
use App\Model\Inventory\maintenance\InventoryTableItemImages;

trait InventoryItemTrait
{

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

	protected function product_data()
	{
		return InventoryTableItem::with('itemGroup')->with('itemImages')->with('itemVariants')->with('itemUnit')->with('itemSupplier')->orderBy('item_id','asc')->get();
	}

	public function inventory_show_product_details($method, $id, $request)
	{
		$product =  InventoryTableItem::where('item_id',$request->id)->first();
		return view('manage.inventory.maintenance.includes.productdetails',['product' => $product]);
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

		$itemProduct = new InventoryTableItem;

		$itemProduct->item_group            = $request->input('item_group');
		$itemProduct->item_supplier         = $request->input('item_supplier');
		$itemProduct->item_warehouse        = $request->input('item_warehouse');
		$itemProduct->item_image            = collect($request->media)->first()['product_image'];
		// $itemProduct->item_variant  = $request->input('item_variant');
		$itemProduct->item_type             = $request->input('item_type');
		$itemProduct->item_code             = $request->input('item_code');
		$itemProduct->item_description      = $request->input('item_description');
		$itemProduct->item_long_description = $request->input('item_long_description');

		$itemProduct->item_purchase_price   = str_replace(',', '', $request->input('total_purchase'));
		$itemProduct->item_selling_price    = str_replace(',', '', $request->input('total_sales'));
		$itemProduct->item_quantity         = str_replace(',', '', $request->input('total_quantity'));
		
		$itemProduct->item_min_quantity     = $request->input('item_min_quantity');
		$itemProduct->item_expiry_date      = $request->input('expiry_date');
		$itemProduct->item_purchase_date    = $request->input('item_purchase_date');
		$itemProduct->item_condition        = $request->input('item_condition');
		/* Credits */
		$itemProduct->created_by            = $this->thisUser()->users_id;
		$itemProduct->created_date          = (new Carbon)->now();

		if( $itemProduct->save() ) {

			$this->inventory_create_variant($method, $itemProduct->item_id, $request);

			$this->inventory_create_item_images($method, $itemProduct->item_id, $request);
			
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