<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableUnit;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryUnitMeasureTrait
{

	public function unit_data()
	{
		$unit = new InventoryTableUnit;

		$unit = $unit->when(!is_null(request()->get('search')), function($query) {
			return $query->where('unit_code','like','%'.request()->get('search').'%')->orWhere('unit_description','like','%'.request()->get('search').'%');
		});

		return $unit->orderBy('order_level','asc')->get();
	}

	public function inventory_create_unit_measure($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableUnit::insert([
					'unit_code'        => $value['code'],
					'unit_description' => $value['description'],
					'created_by'            => $this->thisUser()->users_id,
					'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'           => (new CommenService)->orderLevel(new InventoryTableUnit),
				]);
			}
			$request->session()->flash('success','Unit(s) successfully created');
			return back();
		}
	}
}