<?php

namespace App\Http\Traits\Retrieves;

use App\Model\Accounts\UsersWindowAccess;

trait SystemSideBarTrait
{

	public function usersMenus()
	{	
		return $this->createUsersMenus($this->usersMenusAccess());
	}

	public function usersMenusAccess($parentCode = null)
	{

		$parent_code = (is_null($parentCode)) ? '' : $parentCode ; 

		return (new UsersWindowAccess)
					->where('access_window_code_parent', $parent_code)
					->where('access_users_id', Auth()->User()->users_id)
					->where('access_module_id', $this->activeModule()->module_id)
					->where('access_company_id', $this->usersDefaultCompany()->company_id)

					->where('status', '1')->orderBy('order_level', 'asc')->get();
	}

	public function createUsersMenus($array, $windows = []) 
	{

		foreach ($array as $key => $value) {

			$activeTag = ($value->systemWindow['window_path'] == active_path()) ? 'active' : null ;

			$value = collect($value)->merge([
				'window_icon'   => $value->systemWindow['window_icon'] ,
				'window_path'   => $value->systemWindow['window_path'] , 
				'window_name'   => $value->access_window_name , 
				'window_type'   => $value->access_window_type , 
				'window_active' => $activeTag ,
				'window_module' => active_module() ,
			]);

			$value = collect($value)->merge([
				'window_sub_class' => $this->createUsersMenus($this->usersMenusAccess($value['access_window_code']))
			]);

			foreach($value['window_sub_class'] as $checkactive) {
				( !is_null($checkactive['window_active']) ) ? array_add($value, 'window_active', 'active') : null ;
			}

			$windows[] = collect($value)->only([
				'window_type', 'window_path', 'window_icon', 'window_name', 'window_active', 'window_module', 'window_sub_class',
			]);
		}

		return $windows;
	}
}