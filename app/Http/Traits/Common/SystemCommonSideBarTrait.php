<?php

namespace App\Http\Traits\Common;

use App\Model\Accounts\UsersWindowAccess;

trait SystemCommonSideBarTrait
{

	public function getActiveSideBar()
	{	
		return $this->systemWindowSub($this->usersWindowAccess(0));

		// return UsersWindowAccess::where('menu_parent','=', 0)->with('childrenCategories')->get();
	}

	protected function usersWindowAccess($parent)
	{
		$user = $this->thisUser();

		$modu = $this->getModulePrefix();

		return (new UsersWindowAccess)->where('company_id', $user->company_id)
					
					->where('menu_parent', $parent)
					
					->where('users_id', $user->users_id)
					->where('module_id', $modu->module_id)

					->where('status', '1')->orderBy('order_level', 'asc')->get();
	}

	protected function systemWindowSub($array, $windows = []) 
	{

		foreach ($array as $key => $value) {

			$activeTag = ($value->systemWindow['menu_path'] == active_path()) ? 'active' : null ;

			$value = collect($value)->merge([
				'menu_icon'   => $value->systemWindow['menu_icon'] ,
				'menu_path'   => $value->systemWindow['menu_path'] , 
				'menu_active' => $activeTag ,
				'menu_module' => active_module() ,
			]);

			$value = collect($value)->merge([
				'menu_sub_class' => $this->systemWindowSub($this->usersWindowAccess($value['menu_id']))
			]);

			foreach($value['menu_sub_class'] as $checkactive) {
				( !is_null($checkactive['menu_active']) ) ? array_add($value, 'menu_active', 'active') : null ;
			}

			$windows[] = collect($value)->only([
				'menu_type', 'menu_path', 'menu_icon', 'menu_name', 'menu_active', 'menu_module', 'menu_sub_class',
			]);
		}

		return $windows;

	}
}