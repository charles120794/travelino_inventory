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