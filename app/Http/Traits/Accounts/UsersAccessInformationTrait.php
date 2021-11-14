<?php

namespace App\Http\Traits\Accounts;

use Auth;
use Crypt;
use Session;
use App\User;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersAccessInformationTrait 
{
	public function usersInfo($UserID = null)
	{
		return ( is_null($UserID) ) ? Auth()->User() : User::where('users_id', $UserID)->first() ; 
	}
}