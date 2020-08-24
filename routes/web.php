<?php

Route::get('/', 'Main\HomeController@index');
/* Check if the Users Exists to this App */
Route::post('/login/api/auth/check', 'Manage\Api\LoginController@loginApiAuthCheck');

Route::get('/login/api/auth/success/{module}/{user}','Manage\Api\LoginController@loginModuleRedirect')->name('login.api');

Auth::routes();

Route::get('/welcome','Manage\Api\LoginController@logoutModuleRedirect');

Route::middleware(['auth'])->prefix('inventory')->group(function(){
    Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Manage\Admin\Inventory\InventoryController@activeAdmin')->name('inventory.route');
}); 

Route::middleware('auth')->prefix('accounts')->group(function(){
    Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Manage\System\Accounts\AccountsController@activeAdmin')->name('accounts.route');
}); 

Route::middleware('auth')->prefix('settings')->group(function(){
    Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Manage\System\Settings\SettingsController@activeAdmin')->name('settings.route');
});

Route::middleware('auth')->prefix('common')->group(function(){
    Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Common\CommonController@activeAdmin')->name('common.route');
}); 
