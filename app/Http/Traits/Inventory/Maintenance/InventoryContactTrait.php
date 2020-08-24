<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
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

		return $contact->orderBy('order_level','asc')->get();
	}

	public function inventory_create_contact($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableContact::insert([
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
			$request->session()->flash('success','Contact(s) successfully created');
			return back();
		}
	}
}