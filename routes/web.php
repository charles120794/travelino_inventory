<?php

Route::get('/categories', 'CategoryController@index');

Route::middleware(['auth'])->prefix('inventory')->group(function(){

    // Route::get('/collect/customers', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer')->name('inventory.collect.customer');
    // Route::get('/collect/customers/json', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer_json')->name('inventory.collect.customer.json');

    // Route::post('/collect/customers/json/id', 'Manage\Admin\Inventory\InventoryController@inventory_retrieve_customer_json_id')->name('inventory.collect.customer.json.id');
    // Route::post('/{path}/{action?}/{id?}', 'Manage\Admin\Inventory\InventoryController@activeAdmin')->name('inventory.json.get');

    Route::get('/moduleNotFound', function(){
        return view('manage.exceptions.moduleNotFound');
    })->name('exception.modulenotfound');

}); 

Route::middleware(['auth'])->group(function(){

    Route::prefix('inventory')->match(['get', 'post'],
        '/{path}/{action?}/{id?}','Manage\Admin\Inventory\InventoryController@usersAccessGate'
    )->name('inventory.route');

}); 

Auth::routes();

Route::get('/', function(){ 
    return view('auth.login3'); 
})->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/welcome','Manage\Api\LoginController@logoutModuleRedirect');
