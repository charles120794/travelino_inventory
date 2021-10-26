<?php

namespace App\Http\Traits\Accounts;

use Session;
use Illuminate\Http\Request;

trait UsersWindowLoaderTrait 
{	
	public function accounts_dashboard($window)
	{
		return $this->myViewLoader($window);
	}

	public function accounts_users($window)
	{
		$allUsers = $this->companyUsers($this->thisUser()->company_id);
		
		$usersCompany = $this->usersCompany($this->thisUser()->users_id);

		return $this->myViewLoader($window)
				->with('allSelected', false)
				->with('allUsers', $allUsers)
				->with('usersCompany', $usersCompany);
	}

	public function accounts_users_window_access($window)
	{
		$userModuleAccess = $this->usersAllModule($this->thisUser()->users_id, $this->thisUser()->company_id);

		$userWindowAccess = $this->thisUser();

		$userWindowAccess = $userWindowAccess->windowAccess();

		$userWindowAccess = $userWindowAccess->when(request()->has('module'), function($query){
			return $query->where('module_id', request()->get('module'));
		});

		$userWindowAccess = $userWindowAccess->when(request()->has('company'), function($query){
			return $query->where('company_id', request()->get('company'));
		});

		$userWindowAccess = (request()->has('module')) ? $userWindowAccess->orderBy('order_level','asc')->get() : [] ;

		return $this->myViewLoader($window)
				->with('users_module', $userModuleAccess)
				->with('users_window', $userWindowAccess);
	}

	public function accounts_users_profile($window)
	{
		$thisUser = $this->thisUser();
		
		return $this->myViewLoader($window)->with('thisUserAccount', $thisUser);
	}
}