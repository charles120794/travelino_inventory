<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait UsersCommonTrait 
{

	public function allUsers($user = [])
	{
		$users = app('Users');

		return (count($user) > 0) ? $users->whereIn('users_id', $user)->orderBy('order_level','asc')->get() : 

									$users->orderBy('order_level','asc')->get() ; 
	}

	public function activeUsers($user = null)
	{
		$users = app('Users')->where('status','1');

		return (!is_null($user)) ? $users->where('users_id', $user)->first() : $users->orderBy('order_level','asc')->get() ; 
	}

	public function usersAllDefaultModule($default = 'yes')
	{
		$systemModule = app('SystemModule')->where('module_visibility','visible');

		$systemModule = $systemModule->when(!is_null($default), function($query) use ($default) {
			return $query->where('module_default', $default); 
		});

		return $systemModule->orderBy('order_level','asc')->get(); 
	}

	public function usersAllModule($user = null, $company = null, $default = null)
	{
		$UsersModuleAccess = app('UsersModuleAccess');

		$UsersModuleAccess = $UsersModuleAccess->when(!is_null($user), function($query) use ($user) {
			return $query->where('users_id', $user); 
		});

		$UsersModuleAccess = $UsersModuleAccess->when(!is_null($company), function($query) use ($company) {
			return $query->where('company_id', $company); 
		});

		$UsersModuleAccess = $UsersModuleAccess->orderBy('order_level','asc')->get();

		$modules = array_pluck($UsersModuleAccess, 'module_id');

		return (count($modules) > 0) ? $this->allModule($modules, $default) : [] ;
	}

	public function usersAllWindow($user = null, $company = null, $module = null)
	{
		$UsersWindowAccess = app('UsersWindowAccess')->query();

		$UsersWindowAccess->where('users_id', $user);

		$UsersWindowAccess->when( !is_null($company) , function($query) use ($company) {
			return $query->where('company_id', $company); 
		});

		$UsersWindowAccess->when( !is_null($module) , function($query) use ($module) {
			return $query->where('module_id', $module); 
		});

		$UsersWindowAccess->orderBy('order_level','asc');

		$window = array_pluck($UsersWindowAccess->get(), 'menu_id');

		return (count($window) > 0) ? $this->allWindow($window) : [] ;
	}

	public function usersAllWindowMethod($user = null, $company = null, $module = null, $window = null)
	{
		$UsersMethodAccess = app('UsersWindowMethodAccess')->query();

		$UsersMethodAccess->where('users_id', $user);

		$UsersMethodAccess->when( !is_null($company) , function($query) use ($company) {
			return $query->where('company_id', $company); 
		});

		$UsersMethodAccess->when( !is_null($module) , function($query) use ($module) {
			return $query->where('module_id', $module); 
		});

		$UsersMethodAccess->when( !is_null($window) , function($query) use ($window) {
			return $query->where('menu_id', $window); 
		});

		$UsersMethodAccess->orderBy('order_level','asc');

		$methods = array_pluck($UsersMethodAccess->get(), 'method_id');

		return (count($methods) > 0) ? $this->allWindowMethod($methods) : [] ;
	}
	
	public function usersCompany($user = null)
	{
		$company = $this->getUserCompanyAccess($user);

		return (count($company) > 0) ? $this->allCompany($company) : [] ;
	}

	public function usersActiveModule($user = null)
	{
		$usersModuleAccess = app('UsersModuleAccess')->where('users_id', $user)->where('status','1')->orderBy('order_level','asc')->get(); 

		$modules = array_pluck($usersModuleAccess, 'module_id');

		return (count($modules) > 0) ? $this->allModule($modules) : [] ;
	}

	public function usersActiveWindow($user = null)
	{
		$modu = $this->getModulePrefix();

		$usersWindowAccess = app('UsersWindowAccess')
									->where('status','1')
									->where('users_id', $user->users_id)
									->where('module_id', $modu->module_id)
									->where('company_id', $user->company_id)
									->get(); 

		$windows = array_pluck($usersWindowAccess, 'menu_id');

		return (count($windows) > 0) ? $this->allWindow($windows) : [] ; 
	}

	public function usersActiveWindowMethod($user = null)
	{
		$modu = $this->getModulePrefix();

		$path = $this->getWindowActivePath();

		$windowMethods = app('UsersWindowMethodAccess')->where('status','1')
									->where('menu_id', $path->menu_id)
									->where('users_id', $user->users_id)
									->where('module_id', $modu->module_id)
									->where('company_id', $user->company_id)
									->get();

		$usersWindowMethodAccess = array_pluck($windowMethods, 'method_id');

		return (count($usersWindowMethodAccess) > 0) ? $this->allWindowMethod($usersWindowMethodAccess) : [] ;
	}

	public function usersAllCompany($user = null)
	{
		$thisUser = $this->getUser(encrypt($user));
		
		$UsersCompanyAccess = app('UsersCompanyAccess')->where('users_id', $user)->orderBy('order_level','asc')->get();

		$company = array_pluck($UsersCompanyAccess, 'company_id');

		return (count($UsersCompanyAccess) > 0) ? $this->allCompany($company) : $this->allCompany([$thisUser->company_id]) ;
	}

	public function usersActiveCompany($user = null)
	{
		$UsersCompanyAccess = app('UsersCompanyAccess')->where('users_id', $user)->where('status','1')->orderBy('order_level','asc')->get(); 

		$company = array_pluck($UsersCompanyAccess, 'company_id');

		return (count($company) > 0) ? $this->allCompany($company) : [] ; 
	}

}