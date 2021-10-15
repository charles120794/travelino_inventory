<?php

use Faker\Generator as Faker;
use App\Http\Controllers\Common\CommonServiceController as CommenService;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\User;


Route::get('/bingo/cards', 'Bingo\BingoController@bingo');
Route::get('/bingo/create', 'Bingo\BingoController@createCards');
Route::get('/bingo/create/numbers', 'Bingo\BingoController@createCardsNumbers');

/**
 * 
 */

/**
 * 
 */

/**
 * 
 */

/**
 * 
 */


Route::get('/pizza', 'Pizza\PizzaController@index');

Route::get('/test-middleware', 'CreateUsersProfile@index');

Route::get('/page-error', function(){
	return 'Page Error';
});

Route::get('/login/to/api', function(){

	$user =  User::find(1);

	$user->created_date = $user->created_date;

	return request()->cookie();
	
	return response('Hello World')->cookie(
	    'name', 'charles', 45
	);

	return Auth::once(['email' => 'wongcharlesdave@gmail.com', 'password' => 'charlesdave']);

});

Route::post('/hack/test', function(){
	return 'hacked';
});

Route::get('/fake-customer', function(Faker $faker, $result = []){

	for($i = 0; $i < 1000; $i++) {

		$address    = array_pluck(\App\Model\Inventory\maintenance\InventoryTableAddress::get(),'address_id');
		$addressID  = collect($address)->shuffle()->first();

		$contact   = array_pluck(\App\Model\Inventory\maintenance\InventoryTableContact::get(),'contact_id');
		$contactID = collect($contact)->shuffle()->shuffle()->first();

		// \App\Model\Inventory\maintenance\InventoryTableCustomer::insert([
		// 	'customer_address' => $addressID,
		// 	'customer_contact' => $contactID,
		// 	'customer_code'    => strtoupper(uniqid()),
		// 	'customer_description' => $faker->name,
		// 	'created_by'       => 1,
		// 	'created_date'     => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
		// 	'order_level'      => (new CommenService)->orderLevel(new InventoryTableCustomer),
		// ]);
	}

});

Route::get('/fake-data', function(){

	for($i = 0; $i < 1000; $i++) {

		$supplier    = array_pluck(\App\Model\Inventory\maintenance\InventoryTableSupplier::get(),'supplier_id');
		$supplierID  = collect($supplier)->shuffle()->first();

		$warehouse   = array_pluck(\App\Model\Inventory\maintenance\InventoryTableWarehouse::get(),'warehouse_id');
		$warehouseID = collect($warehouse)->shuffle()->first();

		$unit        = array_pluck(\App\Model\Inventory\maintenance\InventoryTableUnit::get(),'unit_id');
		$unitID      = collect($unit)->shuffle()->first();

		$itemGrp     = array_pluck(\App\Model\Inventory\maintenance\InventoryTableItemGroup::where('group_type',0)->get(),'group_id');
		$itemGrpID   = collect($itemGrp)->shuffle()->first();

	    // \App\Model\Inventory\maintenance\InventoryTableItem::insert([
	    //     'item_group'            => $itemGrpID,
	    //     'item_supplier'         => $supplierID,
	    //     'item_warehouse'        => $warehouseID,
	    //     'item_unit'             => $unitID,
	    //     'item_code'             => strtoupper(uniqid()),
	    //     'item_type'             => 'sales',
	    //     'item_description'      => 'Lorem ipsum dolor ' . uniqid() . ' sit amet, adipiscing elit, ' . uniqid(),
	    //     'item_long_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	    //     'item_purchase_price'   => rand(1, 100),
	    //     'item_selling_price'    => rand(100, 1000),
	    //     'item_quantity'         => rand(100, 500),
	    //     'created_by'            => 1,
	    //     'created_date'           => date('Y/m/d h:i:s'),
	    // ]);

	}

});

Route::get('/', 'Main\HomeController@index');
/* Check if the Users Exists to this App */
Route::post('/login/api/auth/check', 'Manage\Api\LoginController@loginApiAuthCheck');

Route::get('/login/api/auth/success/{module}/{user}','Manage\Api\LoginController@loginModuleRedirect')->name('login.api');

Auth::routes();

Route::get('/welcome','Manage\Api\LoginController@logoutModuleRedirect');

Route::middleware(['auth'])->prefix('inventory')->group(function(){

    Route::get('/collect/customers', 'Manage\Admin\Inventory\InventoryController@html_collect_customers')->name('inventory.collect.customer');

    Route::get('/collect/customers/json', 'Manage\Admin\Inventory\InventoryController@html_collect_customers_json')->name('inventory.collect.customer.json');

    Route::post('/collect/customer/id/json', 'Manage\Admin\Inventory\InventoryController@json_collect_customer_by_id')->name('inventory.collect.customer.id');

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

// Route::middleware('auth')->prefix('common')->group(function(){
//     Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Common\CommonController@activeAdmin')->name('common.route');
// }); 

