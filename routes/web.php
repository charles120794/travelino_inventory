<?php

Route::get('/', function(){
    return view('auth.login3');
});

Auth::routes();

Route::get('/welcome','Manage\Api\LoginController@logoutModuleRedirect');

Route::middleware(['auth'])->prefix('inventory')->group(function(){

    Route::get('/collect/customers', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer')->name('inventory.collect.customer');
    Route::get('/collect/customers/json', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer_json')->name('inventory.collect.customer.json');

    Route::post('/collect/customers/json/id', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer_json_id')->name('inventory.collect.customer.json.id');
    Route::post('/{path}/{action?}/{id?}', 'Manage\Admin\Inventory\InventoryController@activeAdmin')->name('inventory.json.get');

}); 

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
