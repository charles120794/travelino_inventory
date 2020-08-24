<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait SystemCommonAccessTrait
{
	/* 
	 * Get the specifig Company Information 
	 */
	public function getCompany($company = null)
	{
		return app('SystemCompany')->where('company_id', $company)->first();
	}
	/* 
	 * System Company 
	 */
	public function allCompany($company = [])
	{
		$systemCompany = app('SystemCompany');

		return (count($company) > 0) ? $systemCompany->whereIn('company_id', $company)->orderBy('order_level','asc')->get() : 

									   $systemCompany->orderBy('order_level','asc')->get() ; 
	}



	public function activeCompany($company = null)
	{
		$systemCompany = app('SystemCompany')->where('status','1');

		return (!is_null($company)) ? $systemCompany->where('company_id', $company)->first() : $systemCompany->get() ; 
	}

	public function companyPlan($planID)
	{
		return app('SystemCompanyPlan')->where('plan_id', $planID)->first();
	}
	/*
 	* Get Company Module
	*/
	public function companyModule($company = null)
	{
		$companyModule = (!is_null($company)) ? $this->activeCompany($company)->companyModuleInfo : [] ;

		$modules = array_pluck($companyModule, 'module_id');

		return (count($modules) > 0) ? $this->allModule($modules) : [] ; 
	}
	/*
 	* Get Company Users
	*/
	public function companyUsers($company = null)
	{
		$companyUsers = (!is_null($company)) ? $this->activeCompany($company)->usersInfo : [];

		$users = array_pluck($companyUsers, 'users_id');

		return (count($users) > 0) ? $this->allUsers($users) : []; 
	}
	/*
	 * System Module
	 */
	public function moduleWindow($module = null)
	{
		$moduleWindow = (!is_null($module)) ? $this->activeModule($module)->windowInfo : [] ;

		$window = array_pluck($moduleWindow, 'menu_id');

		return (count($window) > 0) ? $this->allWindow($window) : [] ; 
	}

	public function nestedModuleWindow($module = null)
	{
		return app('SystemWindow')->where('module_id', $module)->where('menu_parent','0')->with('subClassWindow')->get();
	}

	public function moduleWindowMethod($module, $window)
	{
		$windowMethod = app('SystemWindowMethod')->where('module_id', $module)->where('menu_id', $window)->get();

		$moduleWindowMethod = array_pluck($windowMethod, 'method_id');

		return (count($moduleWindowMethod) > 0) ? $this->allWindowMethod($moduleWindowMethod) : [] ; 
	}
	/*
	 * System Window
	 */
	public function allWindow($windows = [], $withoutDropDownMenu = false)
	{
		$systemWindow = app('SystemWindow');

		$systemWindow = $withoutDropDownMenu ? $systemWindow->where('menu_type','0') : $systemWindow ;

		return (count($windows) > 0) ? $systemWindow->whereIn('menu_id', $windows)->orderBy('order_level','asc')->get() : 

									   $systemWindow->orderBy('order_level','asc')->get() ; 
	}

	public function allWindowWithDropdown($module = null)
	{
		return app('SystemWindow')->where('module_id', $module)->where('menu_type','1')->get();
	}

	public function allActiveWindow($windows = null)
	{
		$systemWindow = app('SystemWindow')->where('menu_status','1')->where('menu_type','0');

		return (!is_null($windows) > 0) ? $systemWindow->where('menu_id', $windows)->first() : 

									      $systemWindow->orderBy('module_id','asc')->orderBy('order_level','asc')->get() ; 
	}

	public function allWindowMethod($methods = [])
	{
		$systemWindowMethod = app('SystemWindowMethod');

		return (count($methods) > 0) ? $systemWindowMethod->whereIn('method_id', $methods)->orderBy('order_level','asc')->get() : 

									   $systemWindowMethod->orderBy('order_level','asc')->get() ; 
	}

}