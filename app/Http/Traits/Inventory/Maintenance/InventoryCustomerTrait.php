<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableContact;
use App\Model\Inventory\maintenance\InventoryTableAddress;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryCustomerTrait
{
	public function customer_data()
	{
		$customer = new InventoryTableCustomer;

		$customer = $customer->when(!is_null(request()->get('search')), function($query) {
			  return $query->where('customer_code','like','%'.request()->get('search').'%')
						 ->orWhere('customer_description','like','%'.request()->get('search').'%')
						 ->orWhere('customer_tin','like','%'.request()->get('search').'%')
						 ->orWhere('customer_business_style','like','%'.request()->get('search').'%');
		});

		return $customer->orderBy('customer_description','asc')->paginate(10);
	}

	public function inventory_retrieve_customer($method, $id, $request)
	{
		return (new InventoryTableCustomer)->where('customer_id', $request->id)->with('customerAddress')->with('customerContact')->first();
	}

	public function inventory_create_customer($method, $id, $request)
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

		$this->inventory_insert_customer($request, $contactID, $addressID);

		$request->session()->flash('success','Customer successfully created');
		return back();
	}

	public function inventory_insert_customer($request, $contactID = NULL, $addressID = NULL)
	{
		InventoryTableCustomer::insert([
			'customer_address'        => $addressID,
			'customer_contact'        => $contactID,
			'customer_code'           => $request->input('code'),
			'customer_description'    => $request->input('description'),
			'customer_tin'            => $request->input('tin'),
			'customer_business_style' => $request->input('business_style'),
			'customer_tax_type'       => $request->input('tax'),
			'customer_currency'       => $request->input('currency_id'),
			'created_by'              => $this->thisUser()->users_id,
			'created_date'            => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
			'order_level'             => (new CommenService)->orderLevel(new InventoryTableCustomer),
		]);
	}

	public function inventory_update_customer($method, $id, $request)
	{
		if($this->inventory_save_update_customer($request)) {
			
			$this->inventory_save_update_address($request);

			$this->inventory_save_update_contact($request);

			$request->session()->flash('success' , 'Customer successfully updated');
			return back();
		} else {
			$request->session()->flash('success' , 'No changes has been made');
			return back();
		}
	}

	public function inventory_save_update_customer($request)
	{
		return (new InventoryTableCustomer)
					->where('customer_id', $request->customer_id)
					->update([
						'customer_description' => $request->input('customer_description'),
						'updated_by'           => $this->thisUser()->users_id,
						'updated_date'         => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					]);
	}

	public function inventory_delete_customer($method, $id, $request)
	{
		$validateExist = (new InventoryTableCustomer)
							->where('customer_id', decrypt($id))
							->whereHas('customerAddress')
							->whereHas('customerContact')
							->count();

		if($validateExist > 0) {
			$request->session()->flash('failed','Cannot delete Customer in used');
			return back();
		} else {
			InventoryTableCustomer::where('customer_id', decrypt($id))->delete();

			$request->session()->flash('success','Customer successfully deleted');
			return back();
		}
	}
}