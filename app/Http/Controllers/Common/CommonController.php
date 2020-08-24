<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

use App\Http\Traits\Accounts\UsersAccountTrait;
use App\Http\Traits\Accounts\UsersSettingTrait;
use App\Http\Traits\Settings\SystemMediaUploaderTrait;

class CommonController extends Controller 
{
	use UsersAccountTrait, SystemMediaUploaderTrait, UsersSettingTrait;
}