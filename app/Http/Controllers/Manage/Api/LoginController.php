<?php

namespace App\Http\Controllers\Manage\Api;

use Hash;
use Auth;
use Crypt;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller 
{

	public function loginApiAuthCheck(Request $request)
	{

		$credentials = $request->validate([
		    'personal_email' => 'required|string|email',
		    'username'       => 'required|string',
		]);

		$userCount = User::where('personal_email', $credentials['personal_email'])->where('username', $credentials['username'])->first();

	    if (count($userCount) > 0) {

	    	$token = $userCount->createToken('accessToken')->accessToken;

	    	return response()->json(['user' => $userCount, 'token' => $token], 200);

	    } else {
	    	/* Register User */
	    	User::insert([
	    		'users_id' 				    => 		$request['users_id'],
	    		'company_id' 				=> 		$request['company_id'],
	    		'users_window_access' 		=> 		$request['users_window_access'],
	    		'users_type' 				=> 		$request['users_type'],
	    		'personal_address_id' 		=> 		$request['personal_address_id'],
	    		'firstname' 				=> 		$request['firstname'],
	    		'middlename' 				=> 		$request['middlename'],
	    		'lastname' 					=> 		$request['lastname'],
	    		'username' 					=> 		$request['username'],
	    		'business_email' 			=> 		$request['business_email'],
	    		'business_contact_phone' 	=> 		$request['business_contact_phone'],
	    		'business_position' 		=> 		$request['business_position'],
	    		'personal_email' 			=> 		$request['personal_email'],
	    		'personal_contact_phone' 	=> 		$request['personal_contact_phone'],
	    		'personal_tin' 				=> 		$request['personal_tin'],
	    		'personal_phillhealth' 		=> 		$request['personal_phillhealth'],
	    		'personal_license_number' 	=> 		$request['personal_license_number'],
	    		'birth_date' 				=> 		$request['birth_date'],
	    		'profile_path' 				=> 		$request['profile_path'],
	    		'remember_token' 			=> 		$request['remember_token'],
	    		'email_verified_at' 		=> 		$request['email_verified_at'],
	    		'users_status' 				=> 		$request['users_status'],
	    		'created_by'  				=> 		$request['created_by'],
	    	]);

	        return response()->json([
	        	'message' => 'User Account successfully registered',
	        	'redirect' => route('login.api',['module' => $request['module_id'], 'user' => $request['users_id']]),
	        ],200);

	    }

	}

	public function loginModuleRedirect($moduleID = null, $user = null, Request $request)
	{
		
		$userCount = User::where('users_id', decrypt($user));

		if($userCount->count() > 0) {

			$user = User::find(decrypt($user));
			/* Login this User */
			Auth::login($user);
			/* Get Module info */
			$module = module_redirect(decrypt($moduleID));
			/* Redirect to Module */
			return redirect($module['module_prefix'].'/'.$module['module_route']);

		} else {

			$request->session('flash','Invalid user account.');
			return redirect(config('redirect_to.login'));

		}

	}

	public function logoutModuleRedirect()
	{
		Auth::logout();
		
		return redirect(config('module.redirect_to.logout'));
	}

}