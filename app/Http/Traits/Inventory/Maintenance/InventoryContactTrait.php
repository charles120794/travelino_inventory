<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableAddress;
use App\Model\Inventory\maintenance\InventoryTableContact;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryContactTrait
{
	public function contact_data()
	{
		$contact = new InventoryTableContact;

		$contact = $contact->when(!is_null(request()->get('search')), function($query) {
			return $query->where('contact_code','like','%'.request()->get('search').'%')
						 ->orWhere('contact_description','like','%'.request()->get('search').'%')
						 ->orWhere('contact_number','like','%'.request()->get('search').'%')
						 ->orWhere('contact_position','like','%'.request()->get('search').'%')
						 ->orWhere('contact_email','like','%'.request()->get('search').'%');
		});

		$contact = $contact->where('contact_address', '!=', NULL);

		return $contact->orderBy('contact_description','asc')->paginate(10);
	}

	public function inventory_retrieve_contact($method, $id, $request)
	{
		return (new InventoryTableContact)
					->where('contact_id', $request->id)
					->first();
	}

	public function inventory_create_contact($method, $id, $request)
	{
		if(!is_null($request->input('address'))) {

			$this->inventory_insert_address($request);

			$addressID = InventoryTableAddress::orderBy('address_id','desc')->orderBy('created_date','desc')->first()['address_id'];
		} else {
			$addressID = NULL;
		}

		if($request->has('contact')) {

			$this->inventory_insert_contact($request, $addressID);

			$request->session()->flash('success','Contact(s) successfully created');
			return back();
		}
	}

	public function inventory_insert_contact($request, $addressID = NULL)
	{
		foreach ($request->get('contact') as $key => $value) {
			InventoryTableContact::insert([
				'contact_address'     => $addressID,
				'contact_code'        => $value['code'],
				'contact_description' => $value['description'],
				'contact_number'      => $value['number'],
				'contact_position' 	  => $value['position'],
				'contact_email' 	  => $value['email'],
				'created_by'          => $this->thisUser()->users_id,
				'created_date'        => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
				'order_level'         => (new CommenService)->orderLevel(new InventoryTableContact),
			]);
		}
	}

	public function inventory_update_contact($method, $id, $request)
	{
		if($this->inventory_save_update_contact($request)) {
			
			$this->inventory_save_update_address($request);

			$request->session()->flash('success' , 'Contact successfully updated');
			return back();
		} else {
			$request->session()->flash('success' , 'No changes has been made');
			return back();
		}
	}

	public function inventory_save_update_contact($request)
	{
		$collect = [
			'contact_description' => $request->input('contact_description'),
			'contact_number'      => $request->input('contact_number'),
			'contact_email' 	  => $request->input('contact_email'),
			'contact_position' 	  => $request->input('contact_position'),
			'updated_by'          => $this->thisUser()->users_id,
			'updated_date'        => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		];

		return (new InventoryTableContact)->where('contact_id', $request->contact_id)->update($collect);
	}

	public function inventory_delete_contact($method, $id, $request)
	{
		$contact = (new InventoryTableContact)->where('contact_id', decrypt($id))->first();

		(new InventoryTableAddress)->where('address_id', $contact['contact_address'])->delete();

		$contact->delete();

		$request->session()->flash('success' , 'Contact successfully deleted');
		return back();
	}
}