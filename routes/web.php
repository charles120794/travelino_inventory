<?php

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
});

Route::get('/config-clear', function() {
    Artisan::call('config:clear');
});

Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
});

Route::get('/config-cache', function() {
    Artisan::call('config:Cache');
});

Route::get('/storage-link', function() {
    Artisan::call('storage:link');
});

Route::get('/system-down', function() {
    Artisan::call('down');
});


Route::get('/categories', 'CategoryController@index');

// Auth::routes();



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

Route::middleware('auth')->prefix('filesystem')->group(function(){
    Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Manage\System\Settings\SettingsController@activeAdmin')->name('filesystem.route');
});

Auth::routes();

Route::get('/', function(){ 
    return view('auth.login3'); 
})->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/welcome','Manage\Api\LoginController@logoutModuleRedirect');
