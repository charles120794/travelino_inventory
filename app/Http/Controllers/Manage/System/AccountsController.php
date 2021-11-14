<?php

namespace App\Http\Controllers\Manage\System;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller 
{

	use \App\Http\Traits\Accounts\UsersAccessAccountTrait;
	use \App\Http\Traits\Accounts\UsersAccessCompanyTrait;
	use \App\Http\Traits\Accounts\UsersAccessInformationTrait;
	use \App\Http\Traits\Accounts\UsersAccessModuleTrait;
	use \App\Http\Traits\Accounts\UsersAccessWindowTrait;
	use \App\Http\Traits\Accounts\UsersCollectionModifierTrait;

	use \App\Http\Traits\Accounts\UsersWindowLoaderTrait;
	use \App\Http\Traits\Accounts\UsersMethodLoaderTrait;
	
}