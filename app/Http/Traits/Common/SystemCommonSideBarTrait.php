<?php

namespace App\Http\Traits\Common;

trait SystemCommonSideBarTrait
{

	public function getActiveSideBar()
	{	
		return $this->systemWindowSub($this->usersWindowAccess(0));
	}

	protected function usersWindowAccess($parent)
	{
		$user = $this->thisUser();

		$modu = $this->getModulePrefix();

		return app('UsersWindowAccess')
							->where('users_id', $user->users_id)
							->where('module_id', $modu->module_id)
							->where('company_id', $user->company_id)
							->where('menu_parent', $parent)
							->where('status','1')
							->orderBy('order_level','asc')
							->get();
	}

	protected function systemWindowSub($array, $windows = []) 
	{

		foreach ($array as $key => $value) {

			$systemWindow = $value->systemWindow()->first();

			$activeTag = ($systemWindow['menu_path'] == active_path()) ? 'active' : null ;

			array_add($systemWindow,'menu_active', $activeTag);

			array_add($systemWindow,'menu_module', active_module());

			array_add($systemWindow,'module_code', active_path());

			$windowSubClass = $this->systemWindowSub($this->usersWindowAccess($value->menu_id));

			array_add($systemWindow,'menu_sub',$windowSubClass); 

			foreach($systemWindow['menu_sub'] as $checkactive) {
				( !is_null($checkactive['menu_active']) ) ? array_add($systemWindow, 'menu_active', 'active') : false ;
			}

			$windows[] = $systemWindow;

		}

		return $windows;

	}

}