<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Traits\Gate\MainGate as MainGateTrait;

use App\Http\Traits\Accounts\UsersInformationTrait;

use App\Http\Traits\Common\UsersCommonTrait;
use App\Http\Traits\Common\ModuleCommonAccessTrait as ModuleTrait;
use App\Http\Traits\Common\SystemCommonAccessTrait as SystemTrait;

use App\Http\Traits\Common\SystemCommonSideBarTrait as SideBarTrait;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    use MainGateTrait, UsersInformationTrait, UsersCommonTrait, ModuleTrait, SystemTrait, SideBarTrait;

    public function myViewLoader($window, $array = [])
    {
        return view($window->menu_blade, $array)
                    ->with('path', $window->menu_path)
                    ->with('windowName', $window->menu_name)
                    ->with('windowIcon', $window->menu_icon)
                    ->with('thisUser', $this->thisUser())
                    ->with('activeModule', $this->getModulePrefix())
                    ->with('usersActiveModule', $this->usersActiveModule($this->thisUser()->users_id));
    }

    public function myViewMethodLoader($method, $array = [])
    {
        return view($method->method_blade, $array)
                    ->with('path', $method->systemWindow->menu_path)
                    ->with('windowName', $method->systemWindow->menu_name)
                    ->with('windowIcon', $method->systemWindow->menu_icon)
                    ->with('thisUser', $this->thisUser())
                    ->with('activeModule', $this->getModulePrefix())
                    ->with('usersActiveModule', $this->usersActiveModule($this->thisUser()->users_id));
    }
}
