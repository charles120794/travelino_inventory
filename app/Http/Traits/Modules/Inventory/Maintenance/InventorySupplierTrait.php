<?php

namespace App\Http\Traits\Modules\Inventory\Maintenance;

use Session;
use App\Model\Inventory\maintenance\InventoryTableContact;
use App\Model\Inventory\maintenance\InventoryTableAddress;
use App\Model\Inventory\maintenance\InventoryTableSupplier;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventorySupplierTrait
{
	public function supplier_data()
	{
		$supplier = new InventoryTableSupplier;

		$supplier = $supplier->when(!is_null(request()->get('search')), function($query) {
			  return $query->where('supplier_code','like','%'.request()->get('search').'%')
						 ->orWhere('supplier_description','like','%'.request()->get('search').'%')
						 ->orWhere('supplier_tin','like','%'.request()->get('search').'%')
						 ->orWhere('supplier_business_style','like','%'.request()->get('search').'%');
		});

		return $supplier->orderBy('supplier_description','asc')->paginate(10);
	}

	public function inventory_retrieve_supplier($method, $id, $request)
	{
		return (new InventoryTableSupplier)->where('supplier_id', $request->id)->with('supplierAddress')->with('supplierContact')->first();
	}

	public function inventory_create_supplier($method, $id, $request)
	{
		if(!is_null($request->input('contact'))) {

			$this->inventory_insert_contact($request);

			$contactID = InventoryTableContact::orderBy('contact_id','desc')->orderBy('created_date','desc')->first()['contact_id'];

		} else {
			$contactID = NULL;
		}

		if(!is_null($request->input('address'))) {

			$this->inventory_insert_address($request);

			$addressID = InventoryTableAddress::orderBy('address_id','desc')->orderBy('created_date','desc')->first()['address_id'];
		} else {
			$addressID = $request->get('address_id');
		}

		$this->inventory_insert_supplier($request, $contactID, $addressID);

		$request->session()->flash('success','Supplier successfully created');
		return back();
	}

	public function inventory_insert_supplier($request, $contactID = NULL, $addressID = NULL)
	{
		InventoryTableSupplier::insert([
			'supplier_address'        => $addressID,
			'supplier_contact'        => $contactID,
			'supplier_code'           => $request->input('code'),
			'supplier_description'    => $request->input('description'),
			'supplier_tin'            => $request->input('tin'),
			'supplier_business_style' => $request->input('business_style'),
			'supplier_tax_type'       => $request->input('tax'),
			'supplier_currency'       => $request->input('currency_id'),
			'created_by'              => $this->thisUser()->users_id,
			'created_date'            => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
			'order_level'             => (new CommenService)->orderLevel(new InventoryTableSupplier),
		]);
	}

	public function inventory_update_supplier($method, $id, $request)
	{
		if($this->inventory_save_update_supplier($request)) {
			
			$this->inventory_save_update_address($request);

			$this->inventory_save_update_contact($request);

			$request->session()->flash('success' , 'Supplier successfully updated');
			return back();
		} else {
			$request->session()->flash('success' , 'No changes has been made');
			return back();
		}
	}

	public function inventory_save_update_supplier($request)
	{
		return InventoryTableSupplier::where('supplier_id', $request->supplier_id)->update([
			'supplier_description' => $request->input('supplier_description'),
			'updated_by'           => $this->thisUser()->users_id,
			'updated_date'         => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	public function inventory_delete_supplier($method, $id, $request)
	{
		$validateExist = (new InventoryTableSupplier)
							->where('supplier_id', decrypt($id))
							->whereHas('supplierAddress')
							->whereHas('supplierContact')
							->count();

		if($validateExist > 0) {
			$request->session()->flash('failed','Cannot delete Supplier in used');
			return back();
		} else {
			InventoryTableSupplier::where('supplier_id', decrypt($id))->delete();

			$request->session()->flash('success','Supplier successfully deleted');
			return back();
		}
	}
}