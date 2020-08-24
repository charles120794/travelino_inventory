<?php

namespace App\Http\Traits\Accounts;

use Auth;
use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersInformationTrait 
{
	
	public function thisUser($user = null)
	{
		return (is_null($user)) ? Auth::User() : app('Users')->where('users_id', $user)->first() ; 
	}

	public function getUser($user)
	{
		return app('Users')->where('users_id', decrypt($user))->first();
	}

	public function getUserDefaultCompany($id = null)
	{
		$userId = (is_null($id)) ? $this->thisUser()->users_id : $id ;

		$thisUser = app('Users')->where('users_id', $userId)->first();

		return $thisUser->companyInfo()->first();
	}
	/* Get Company Access of a User in Array of company_id */
	public function getUserCompanyAccess($id)
	{
		$user = app('Users')->where('users_id', $id)->first();

		$companyAccess = $user->companyAccess()->get();

		return (count($companyAccess) > 0) ? array_pluck($companyAccess,'company_id') : [];
	} 

	public function getUserModuleAccess($userID, $companyID)
	{
		$users = app('Users')->where('users_id', $userID)->first();

		$moduleAccess = $users->moduleAccess()->where('company_id', $companyID)->get();

		return (count($moduleAccess) > 0) ? array_pluck($moduleAccess,'module_id') : [];
	} 
	/* USERS WINDOW ACCESS */
	public function getUserWindowAccess($id, $company, $module = null)
	{
		$user = app('Users')->where('users_id', $id)->first();

		$windowAccess = $user->windowAccess()->where('company_id', $company);

		$windowAccess = $windowAccess->when(!is_null($module), function($query) use ($module){
			return $query->where('module_id', $module);
		});

		$windowAccess = $windowAccess->get();

		return (count($windowAccess) > 0) ? array_pluck($windowAccess,'menu_id') : [];
	}
	/* USERS METHOD ACCESS */
	public function getUserWindowMethodAccess($id, $company, $module, $window)
	{
		$user = app('Users')->where('users_id', $id)->first();

		$methodAccess = $user->windowMethodAccess()->where('menu_id', $window)->where('company_id', $company)->where('module_id', $module)->get();

		return (count($methodAccess) > 0) ? array_pluck($methodAccess,'method_id') : [] ;
	}

}