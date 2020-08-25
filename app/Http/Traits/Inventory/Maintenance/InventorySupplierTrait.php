<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableContact;
use App\Model\Inventory\maintenance\InventoryTableAddress;
use App\Model\Inventory\maintenance\InventoryTableSupplier;

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

		return $supplier->orderBy('order_level','asc')->get();
	}

	public function inventory_create_supplier($method, $id, $request)
	{

		if(is_null($request->input('contact_id'))) {
			$this->inventory_create_contact($method, $id, $request);
			$contactID = InventoryTableContact::orderBy('contact_id','desc')->orderBy('created_date','desc')->first()['contact_id'];
		} else {
			$contactID = $request->get('contact_id');
		}

		if(is_null($request->input('address_id'))) {
			$this->inventory_create_address($method, $id, $request);
			$addressID = InventoryTableAddress::orderBy('address_id','desc')->orderBy('created_date','desc')->first()['address_id'];
		} else {
			$addressID = $request->get('address_id');
		}

		InventoryTableSupplier::insert([
			'supplier_address' => $addressID,
			'supplier_contact' => $contactID,
			'supplier_code' => $request->get('code'),
			'supplier_description' => $request->get('description'),
			'supplier_tin' => $request->get('tin'),
			'supplier_business_style' => $request->get('business_style'),
			'supplier_tax_type' => $request->get('tax'),
			'supplier_currency' => $request->get('currency_id'),
		]);

		$request->session()->flash('success','Supplier successfully created');
		return back();
	}
}