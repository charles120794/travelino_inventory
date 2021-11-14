<?php

Route::middleware(['auth'])->group(function(){

    Route::prefix('landing')->match(['get', 'post'],
        '/{path}/{action?}/{id?}', 'Manage\System\LandingController@usersLandingPage'
    )->name('filesystem.route');

    Route::prefix('actions')->match(['get', 'post'],
        '/{path}/{action?}/{id?}', 'Manage\System\AccountsController@usersActionGate'
    )->name('actions.route');

    Route::prefix('settings')->match(['get', 'post'],
        '/{path}/{action?}/{id?}', 'Manage\System\SettingsController@usersAccessGate'
    )->name('settings.route');

    Route::prefix('accounts')->match(['get', 'post'],
        '/{path}/{action?}/{id?}', 'Manage\System\AccountsController@usersAccessGate'
    )->name('accounts.route');

    Route::prefix('filesystem')->match(['get', 'post'],
        '/{path}/{action?}/{id?}', 'Manage\System\FileSystemController@usersAccessGate'
    )->name('filesystem.route');

});