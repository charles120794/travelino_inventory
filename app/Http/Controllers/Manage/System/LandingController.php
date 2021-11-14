<?php

namespace App\Http\Controllers\Manage\System;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller 
{
	public function usersLandingPage()
	{
		$user = $this->activeUser();
		$usersMenus = [];
		$activeCompany = $this->activeCompany();
		$usersModule = $this->usersModule();
		$activeModule = $this->activeModule();

		return view('manage.system.landings.usersLanding')
					->with('thisUser', $user)
					->with('usersMenus', $usersMenus)
					->with('activeCompany', $activeCompany)
					->with('usersModule', $usersModule)
					->with('activeModule', $activeModule);
	}
}