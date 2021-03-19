<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableWarehouse;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryWarehouseTrait
{
	public function warehouse_data()
	{
		$warehouse = new InventoryTableWarehouse;

		$warehouse = $warehouse->when(!is_null(request()->get('search')), function($query) {
			return $query->where('warehouse_code','like','%'.request()->get('search').'%')->orWhere('warehouse_description','like','%'.request()->get('search').'%');
		});

		return $warehouse->orderBy('order_level','asc')->get();

	}

	public function inventory_create_warehouse($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableWarehouse::insert([
					'warehouse_code'        => $value['code'],
					'warehouse_description' => $value['description'],
					// 'warehouse_address'     => $value['address'],
					// 'warehouse_contact'     => $value['contact'],
					'created_by'            => $this->thisUser()->users_id,
					'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'           => (new CommenService)->orderLevel(new InventoryTableWarehouse),
				]);
			}
			$request->session()->flash('success','Warehouse(s) successfully created');
			return back();
		}
	}

	public function inventory_update_warehouse($method, $id, $request)
	{
		InventoryTableWarehouse::where('warehouse_id', $request->warehouse_id)->update([
			'warehouse_description'   => $request->warehouse_description,
			'updated_by'              => $this->thisUser()->users_id,
			'updated_date'            => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		$request->session()->flash('success','Warehouse successfully updated');
		return back();
	}

	public function inventory_delete_warehouse($method, $id, $request)
	{
		$validateExist = (new InventoryTableWarehouse)
							->where('warehouse_id', decrypt($id))
							->whereHas('productWarehouse')
							->count();

		if($validateExist > 0) {
			$request->session()->flash('failed','Cannot delete Warehouse in used');
			return back();
		} else {
			InventoryTableWarehouse::where('warehouse_id', decrypt($id))->delete();

			$request->session()->flash('success','Warehouse successfully deleted');
			return back();
		}
	}
}