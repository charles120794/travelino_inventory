<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait InventoryActiveGroupTrait
{

	// $collect = InventoryTableItemGroup::where('group_parent','0')->get();

	// return $this->genaratingChildData($collect,'22');

	public function activeGroupParent($model, $id)
	{	
		return $this->genaratingChildData($this->generatingParentData($model), $id);
	}

	protected function generatingParentData($model)
	{
		return $model->where('group_parent', '0')->orderBy('order_level','asc')->get();
	}

	protected function genaratingChildData($array, $find = 0, $result = []) 
	{

		foreach ($array as $key => $value) {

			$data['code']          = $value->group_code;
			$data['description']   = $value->group_description;
			$data['group_status']  = $value->group_status;
			$data['group_id']      = $value->group_id;

			$data['group_display'] = ($value->group_id == $find) ? 'active' : null ;

			$data['details'] = $this->genaratingChildData($value->groupDetails()->get(), $find);

			foreach($data['details'] as $details) {
				if($details['group_display'] == 'active') {
					$data['group_display'] = 'active';
				}
			}

			if($data['group_display'] == 'active') {
				$result[] = $data;
			}

		}

		return $result;

	}

}