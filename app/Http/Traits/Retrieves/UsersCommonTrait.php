<?php

namespace App\Http\Traits\Retrieves;

use Crypt;
use Session;

use App\User;
use App\Model\Settings\SystemModule;

use Illuminate\Http\Request;

trait UsersCommonTrait 
{
	public function activeUser($usersID = null)
	{
		$users = new User;

		return ( !is_null($usersID) ) 

					? 	$users->where('users_id', $usersID)->first() 

					: 	Auth()->User() ; 
	}

	public function allUsers($usersID = [])
	{
		$users = new User;

		return ( collect($usersID)->isNotEmpty() ) 

					? 	$users->whereIn('users_id', $usersID)->orderBy('order_level','asc')->get() 

					: 	$users->orderBy('order_level', 'asc')->get() ; 
	}

	public function activeUsers($userID = null)
	{
		$users = new User;

		return ( !is_null($userID) ) 

					? 	$users->where('status', '1')->where('users_id', $userID)->first() 

					: 	$users->where('status', '1')->orderBy('order_level','asc')->get() ; 
	}

	public function usersCompany($userID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessCompany = (collect($users->companyAccess)->isNotEmpty()) 

					? 	$users->companyAccess->pluck('companyInfo') : [] ;

		} else {

			$accessCompany = (collect(Auth()->User()->companyAccess)->isNotEmpty()) 

					? 	Auth()->User()->companyAccess->pluck('companyInfo') : [] ;
		}

		return $accessCompany;
	}

	public function usersDefaultCompany($userID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessCompany = (collect($users->companyDefaultAccess)->isNotEmpty()) 

					? 	$users->companyDefaultAccess->companyInfo : [] ;

		} else {

			$accessCompany = (collect(Auth()->User()->companyDefaultAccess)->isNotEmpty()) 

					? 	Auth()->User()->companyDefaultAccess->companyInfo : [] ;
		}
		
		return $accessCompany;
	}

	public function usersModule($userID = null, $companyID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessModule = (collect($users->moduleAccess($companyID))->isNotEmpty()) 

					? 	$users->moduleAccess($companyID)->pluck('moduleInfo') : [] ;

		} else {

			$accessModule = (collect(Auth()->User()->moduleAccess($companyID))->isNotEmpty()) 

					? 	Auth()->User()->moduleAccess($companyID)->pluck('moduleInfo') : [] ;
		}

		return $accessModule;
	}

	public function usersDefaultModule($userID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessModule = (collect($users->moduleDefaultAccess)->isNotEmpty()) 

					? 	$users->moduleDefaultAccess->moduleInfo : [] ;

		} else {

			$accessModule = (collect(Auth()->User()->moduleDefaultAccess)->isNotEmpty()) 

					? 	Auth()->User()->moduleDefaultAccess->moduleInfo : [] ;
		}
		
		return $accessModule;
	}

	public function usersWindow($userID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessWindow = (collect($users->windowAccess)->isNotEmpty()) 

					? 	$users->windowAccess->pluck('windowInfo') : [] ;

		} else {

			$accessWindow = (collect(Auth()->User()->windowAccess)->isNotEmpty()) 

					? 	Auth()->User()->windowAccess->pluck('windowInfo') : [] ;
		}

		return $accessWindow;
	}

	public function usersWindowMethod($userID = null)
	{
		$users = new User;

		if ( !is_null($userID) ) {

			$users = $users->where('users_id', $userID)->first();

			$accessWindowMethod = (collect($users->windowMethodAccess)->isNotEmpty()) 

					? 	$users->windowMethodAccess->pluck('windowMethodInfo') : [] ;

		} else {

			$accessWindowMethod = (collect(Auth()->User()->windowMethodAccess)->isNotEmpty()) 

					? 	Auth()->User()->windowMethodAccess->pluck('windowMethodInfo') : [] ;
		}

		return $accessWindowMethod;
	}
}