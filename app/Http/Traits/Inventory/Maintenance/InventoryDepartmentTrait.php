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
			return $query->where('department_code','like','%'.request()->get('search').'%')
				  	   ->orWhere('department_description','like','%'.request()->get('search').'%');
		});

		return $department->orderBy('department_description','asc')->paginate(10);
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

	public function inventory_update_department($method, $id, $request)
	{
		InventoryTableDepartment::where('department_id', $request->department_id)->update([
			'department_description' => $request->department_description,
			'updated_by'              => $this->thisUser()->users_id,
			'updated_date'            => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		$request->session()->flash('success','Department successfully updated');
		return back();
	}

	public function inventory_delete_department($method, $id, $request)
	{
		$validateExist = (new InventoryTableDepartment)
							->where('department_id', decrypt($id))
							->whereHas('productDepartment')
							->count();

		if($validateExist > 0) {
			$request->session()->flash('failed','Cannot delete Department in used');
			return back();
		} else {
			InventoryTableDepartment::where('department_id', decrypt($id))->delete();

			$request->session()->flash('success','Department successfully deleted');
			return back();
		}
	}

}