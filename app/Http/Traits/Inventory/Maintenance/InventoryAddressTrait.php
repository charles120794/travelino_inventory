<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableAddress;
use App\Model\Inventory\maintenance\InventoryTableContact;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryAddressTrait
{
	public function address_data()
	{
		$address = new InventoryTableAddress;

		$address = $address->when(!is_null(request()->get('search')), function($query) {
			return $query->where('address_number','like','%'.request()->get('search').'%')
						 ->orWhere('address_street','like','%'.request()->get('search').'%')
						 ->orWhere('address_barangay','like','%'.request()->get('search').'%')
						 ->orWhere('address_city','like','%'.request()->get('search').'%')
						 ->orWhere('address_zip','like','%'.request()->get('search').'%');
		});

		$address = $address->where('address_contact', '!=', NULL);

		return $address->orderBy('order_level','asc')->get();
	}

	public function inventory_retrieve_address($method, $id, $request)
	{
		return (new InventoryTableAddress)->where('address_id',$request->id)->with('addressContact')->first();
	}

	public function inventory_create_address($method, $id, $request)
	{
		if(!is_null($request->input('contact'))) {

			$this->inventory_insert_contact($request);

			$contactID = InventoryTableContact::orderBy('contact_id','desc')->orderBy('created_date','desc')->first()['contact_id'];

		} else {
			$contactID = NULL;
		}

		if($request->has('address')) {

			$this->inventory_insert_address($request, $contactID);

			$request->session()->flash('success','Address(es) successfully created');
			return back();
		}
	}

	public function inventory_insert_address($request, $contactID = NULL)
	{
		foreach ($request->get('address') as $key => $value) {
			InventoryTableAddress::insert([
				'address_contact'  => $contactID,
				'address_complete' => $value['number'] . ' ' . $value['street'] . ', ' . $value['barangay'] . ' ' . $value['city'] . ' | ' . $value['zip'],
				'address_code'     => $value['code'],
				'address_number'   => $value['number'],
				'address_street'   => $value['street'],
				'address_barangay' => $value['barangay'],
				'address_city' 	   => $value['city'],
				'address_zip' 	   => $value['zip'],
				'created_by'       => $this->thisUser()->users_id,
				'created_date'     => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
				'order_level'      => (new CommenService)->orderLevel(new InventoryTableAddress),
			]);
		}
	}

	public function inventory_update_address($method, $id, $request)
	{
		if($this->inventory_save_update_address($request)) {
			
			$this->inventory_save_update_contact($request);

			$request->session()->flash('success' , 'Address successfully updated');
			return back();
		} else {
			$request->session()->flash('success' , 'No changes has been made');
			return back();
		}
	}

	public function inventory_save_update_address($request)
	{
		return (new InventoryTableAddress)->where('address_id',$request->address_id)->update([
			'address_complete' => $request->input('address_number') . ' ' . $request->input('address_street') . ', ' . $request->input('address_barangay') . ' ' .  $request->input('address_city') . ' | ' . $request->input('address_zip') ,
			'address_number'   => $request->input('address_number'),
			'address_street'   => $request->input('address_street'),
			'address_barangay' => $request->input('address_barangay'),
			'address_city'     => $request->input('address_city'),
			'address_zip'      => $request->input('address_zip'),
			'updated_by'       => $this->thisUser()->users_id,
			'updated_date'     => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	public function inventory_delete_address($method, $id, $request)
	{
		$address = (new InventoryTableAddress)->where('address_id', decrypt($id))->first();

		(new InventoryTableContact)->where('contact_id', $address['address_contact'])->delete();

		$address->delete();

		$request->session()->flash('success' , 'Address successfully deleted');
		return back();
	}
}