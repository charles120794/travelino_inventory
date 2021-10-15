<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UsersModuleAccessMiddleware;

class CreateUsersProfile extends Controller
{
    public function __construct()
    {
    	$this->middleware('usersmodule');
    }

    public function index()
    {
    	return 'Page Success';
    }
}
