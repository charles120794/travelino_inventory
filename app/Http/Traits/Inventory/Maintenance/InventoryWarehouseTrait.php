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
					'warehouse_address'     => $value['address'],
					'warehouse_contact'     => $value['contact'],
					'warehouse_code'        => $value['code'],
					'warehouse_description' => $value['description'],
					'created_by'            => $this->thisUser()->users_id,
					'created_date'          => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'           => (new CommenService)->orderLevel(new InventoryTableWarehouse),
				]);
			}
			$request->session()->flash('success','Warehouse(s) successfully created');
			return back();
		}
	}
}