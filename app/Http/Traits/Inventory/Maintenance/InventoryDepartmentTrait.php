<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableDepartment;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryDepartmentTrait
{
	public function department_data()
	{
		$department = new InventoryTableDepartment;

		$department = $department->when(!is_null(request()->get('search')), function($query) {
			return $query->where('department_code','like','%'.request()->get('search').'%')->orWhere('department_description','like','%'.request()->get('search').'%');
		});

		return $department->orderBy('order_level','asc')->get();
	}

	public function inventory_create_department($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableDepartment::insert([
					'department_code'        => $value['code'],
					'department_description' => $value['description'],
					'created_by'            => $this->thisUser()->users_id,
					'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'           => (new CommenService)->orderLevel(new InventoryTableDepartment),
				]);
			}
			$request->session()->flash('success','Department(s) successfully created');
			return back();
		}
	}

}