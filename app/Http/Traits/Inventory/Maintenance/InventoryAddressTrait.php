<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableAddress;
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

		return $address->orderBy('order_level','asc')->get();
	}

	public function inventory_create_address($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableAddress::insert([
					'address_number'      => $value['number'],
					'address_street'  	  => $value['street'],
					'address_barangay'    => $value['barangay'],
					'address_city' 	      => $value['city'],
					'address_zip' 	      => $value['zip'],
					'created_by'          => $this->thisUser()->users_id,
					'created_date'        => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'         => (new CommenService)->orderLevel(new InventoryTableAddress),
				]);
			}
			$request->session()->flash('success','Address(es) successfully created');
			return back();
		}
	}
}