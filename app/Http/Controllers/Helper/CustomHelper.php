<?php

use App\Http\Controllers\Common\CommonServiceController as CommonService;

if (! function_exists('active_module')) {
    function active_module() {
        return str_replace('/', '', request()->route()->getPrefix());
    }
}

if (! function_exists('active_path')) {
    function active_path() {
        return str_replace('/', '', request()->route()->parameter('path'));
    }
}

if (! function_exists('active_action')) {
    function active_action() {
        return str_replace('/', '', request()->route()->parameter('action'));
    }
}

if (! function_exists('active_id')) {
    function active_id() {
        return request()->route()->parameter('id');
    }
}

if (! function_exists('module_sidebar')) {
    function module_sidebar() {
        return (new CommonService)->usersMenus();
    }
}