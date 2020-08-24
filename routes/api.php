<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('api')->post('/login', 'Manage\Api\LoginController@login');

Route::middleware('auth:api')->group(function(){

	// Route::get('/user', 'Manage\Api\LoginController@user');

	// Route::post('/custom-login', 'Manage\Api\LoginController@customLogin');
	
});