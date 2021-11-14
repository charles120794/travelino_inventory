<?php

namespace App\Policies;

use App\Model\Settings\SystemModule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemModuleAccessPolicy
{
    use HandlesAuthorization;

    public function moduleNotExists()
    {
        return collect($this->module())->isNotEmpty();
    }

    public function userAccessModule()
    {
        $module = $this->module();

        return in_array($module['module_id'], Auth()->User()->moduleAccess->pluck('access_module_id')->toArray());
    }

    protected function module()
    {
        $prefix = $this->moduleRoutePrefix();

        return SystemModule::where('module_prefix', $prefix)->first();
    }

    protected function moduleRoutePrefix()
    {
        return str_replace('/','',request()->route()->getPrefix());
    }
}
