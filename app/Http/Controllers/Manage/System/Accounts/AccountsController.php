<?php

namespace App\Http\Controllers\Manage\System\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller 
{
	use \App\Http\Traits\Accounts\UsersAccountTrait;
	use \App\Http\Traits\Accounts\UsersSettingTrait;
	use \App\Http\Traits\Accounts\UsersModuleAccessTrait;
	use \App\Http\Traits\Accounts\UsersWindowLoaderTrait;
	use \App\Http\Traits\Accounts\UsersMethodLoaderTrait;
}