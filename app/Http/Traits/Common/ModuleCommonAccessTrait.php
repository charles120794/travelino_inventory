<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait ModuleCommonAccessTrait
{

	public function thisModule()
	{
		return $this->getModulePrefix();
	}
	/* 
	 * System Module
	 */
	public function getModulePrefix()
	{
		$activeModulePrefix = str_replace('/','',request()->route()->getPrefix());

		return app('SystemModule')->where('status','1')->where('module_prefix', $activeModulePrefix)->first();
	}

	public function getModule($module = null)
	{
		return app('SystemModule')->where('module_id', $module)->first();
	}

	public function allModule($modules = [], $default = null)
	{
		$systemModule = app('SystemModule');

		$systemModule = $systemModule->when(!is_null($default), function($query) use ($default) {
			return $query->where('module_default', $default); 
		});

		return (count($modules) > 0) ? $systemModule->whereIn('module_id', $modules)->orderBy('order_level','asc')->get() : 

									   $systemModule->orderBy('order_level','asc')->get() ; 
	}
	/* All Module For Sale */
	public function allDefaultModule($var = 'yes')
	{
		return app('SystemModule')->where('module_default', $var)->where('module_visibility','visible')->orderBy('order_level','asc')->get();
	}

	public function activeModule($module = null)
	{
		$systemModule = app('SystemModule')->where('status','1');

		return (!is_null($module)) ? $systemModule->where('module_id', $module)->first() : $systemModule->get() ; 
	}
	/*
	 * System Module Group
	 */
	public function allModuleGroup($group = [])
	{
		$moduleGroup = app('SystemModuleGroup');

		return (count($group) > 0) ? $moduleGroup->whereIn('group_id', $group)->orderBy('order_level','asc')->get() : 

									 $moduleGroup->orderBy('order_level','asc')->get() ;
	}

	public function activeModuleGroup($group = null)
	{
		$moduleGroup = app('SystemModuleGroup')->where('status','1');

		return (!is_null($group)) ? $moduleGroup->where('group_id', $group)->first() : $moduleGroup->orderBy('order_level','asc')->get() ;
	}

	/* For Module Window */
	public function getWindowActivePath()
	{
		$activePath = str_replace('/', '', request()->route()->parameter('path'));

		return app('SystemWindow')->where('menu_status','1')->where('menu_path', $activePath)->first();
	}
	
}