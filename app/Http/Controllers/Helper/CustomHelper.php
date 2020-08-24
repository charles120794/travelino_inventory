<?php

use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Traits\Common\ModuleCommonAccessTrait;
use App\Model\Settings\SystemCompanyPlan;

class TraitLoaderController
{
    use ModuleCommonAccessTrait;

    public function allCompanyPlan()
    {
        return SystemCompanyPlan::all();
    }

    public function moduleRedirect($module)
    {
        return $this->getModule($module);
    }

}

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
        return (new CommonService)->getActiveSideBar();
    }
}

if (! function_exists('module_for_sale')) {
    function module_for_sale() {
        return (new TraitLoaderController)->allDefaultModule('no');
    }
}

if (! function_exists('module_redirect')) {
    function module_redirect($module) {
        return (new TraitLoaderController)->moduleRedirect($module);
    }
}

if (! function_exists('company_for_sale')) {
    function company_for_sale() {
        return (new TraitLoaderController)->allCompanyPlan();
    }
}