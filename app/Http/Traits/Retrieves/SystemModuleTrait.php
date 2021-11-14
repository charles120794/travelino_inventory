<?php

namespace App\Http\Traits\Retrieves;

use App\Model\Settings\SystemModule;
use App\Model\Settings\SystemModuleGroup;

trait SystemModuleTrait
{

	public function activeModule()
	{
		return SystemModule::where('status','1')->where('module_prefix', active_module())->first();
	}

	public function allModule($modules = [])
	{
		$systemModule = new SystemModule;

		return (collect($modules)->isNotEmpty()) 

				? 	$systemModule->whereIn('module_id', $modules)->orderBy('order_level','asc')->get() 

				: 	$systemModule->orderBy('order_level','asc')->get() ; 
	}

	public function allActiveModule($modules = [])
	{
		return collect($this->allModule($modules))->filter(function($module, $key){
			return $module->status == 1;
		});
	}

	public function allModuleGroup($groups = [])
	{
		$moduleGroup = new SystemModuleGroup;

		return (collect($groups)->isNotEmpty()) 

				? 	$moduleGroup->whereIn('group_id', $groups)->orderBy('order_level','asc')->get() 

				: 	$moduleGroup->orderBy('order_level','asc')->get() ;
	}

	public function allActiveModuleGroup($groups = [])
	{
		return collect($this->allModuleGroup($groups))->filter(function($moduleGroup, $key){
			return $moduleGroup->status == 1;
		});
	}
	
}