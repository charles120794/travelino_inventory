<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableItemGroup;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryItemGroupTrait
{

	public function inventory_create_item_group($method, $id, $request)
	{
		// $this->validate($request,[
		// 	'group_type' => 'required',
		// 	'group_parent' => 'required',
		// 	'group_description' => 'required|max:100',
		// ]);

		foreach ($request->option as $key => $value) {

			$inventoryTableItemGroup = InventoryTableItemGroup::where('group_id', $value['group_parent'])->first();
			
			$group_level = (count($inventoryTableItemGroup) > 0) ? $inventoryTableItemGroup->group_level + 1 : 1 ;

			InventoryTableItemGroup::insert([
				'group_level' => $group_level,
				'group_type' => $value['group_type'],
				'group_parent' => $value['group_parent'],
				'group_code' => strtoupper(substr($value['group_description'], 0,3)),
				'group_description' => $value['group_description'],
				'order_level' => (new CommenService)->orderLevel(new InventoryTableItemGroup),
				'created_by' => $this->thisUser()->users_id,
				'created_date' => (new Carbon)->now(),
			]);

		}

		$request->session('flash','Group successfully created');
		return back();
	}

	public function inventory_search_item_group($method, $id, $request)
	{
		$group_data = InventoryTableItemGroup::where('status','1')
							->where('group_id', $request->group_id)
							->with('groupDetails')->orderBy('order_level','asc')->first();

		return $this->myViewMethodLoader($method,[
			'group_data_id' => $request->group_id,
			'group_parent' => $request->group_parent,
			'group_level' => $request->group_id,
			'group_data' => $group_data,
		]);
	}

	public function inventory_update_item_group($method, $id, $request)
	{
		// return $request->all();
		foreach ($request->group as $key => $value) {
			InventoryTableItemGroup::where('group_id', $key)->update([
				'group_type'        => $value['type'],
				'group_level'       => $value['level'],
				'group_parent'      => $value['parent'],
				'order_level'       => $value['order'],
				'group_description' => $value['description'],
			]);
		}

		return back();
	}
	
	protected function product_group_data()
	{
		$group_data = InventoryTableItemGroup::where('status','1')->orderBy('order_level','asc')->get();

		$group_data_level_1 = InventoryTableItemGroup::where('status','1')->where('group_parent','0')->where('group_level','1')->orderBy('order_level','asc')->get();

		return [
			'group_data' => $group_data,
			'group_data_level_1' => $group_data_level_1,
		];
	}

}