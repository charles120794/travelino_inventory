<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Traits\AccessGate;

use App\Http\Traits\Accounts\UsersAccessInformationTrait;

use App\Http\Traits\Retrieves\SystemCompanyTrait;
use App\Http\Traits\Retrieves\SystemModuleTrait;
use App\Http\Traits\Retrieves\SystemSideBarTrait;
use App\Http\Traits\Retrieves\SystemWindowTrait;
use App\Http\Traits\Retrieves\SystemWindowMethodTrait;
use App\Http\Traits\Retrieves\UsersCommonTrait;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    use AccessGate, 
        UsersAccessInformationTrait, 
        SystemCompanyTrait, 
        SystemModuleTrait, 
        SystemSideBarTrait, 
        SystemWindowTrait, 
        SystemWindowMethodTrait, 
        UsersCommonTrait;

    public function myViewLoader($window, $array = [])
    {
        return view($window->window_blade, $array)
                    ->with('usersMenus', $this->usersMenus())
                    ->with('thisUser', $this->usersInfo())
                    ->with('path', $this->activeWindow()->window_path)
                    ->with('windowPath', $this->activeWindow()->window_path)
                    ->with('windowName', $this->activeWindow()->window_name)
                    ->with('windowIcon', $this->activeWindow()->window_icon)
                    ->with('activeModule', $this->activeModule());
    }

    public function myViewMethodLoader($method, $array = [])
    {
        return view($method->window_method_blade, $array)
                    ->with('usersMenus', $this->usersMenus())
                    ->with('thisUser', $this->usersInfo())
                    ->with('path', $this->activeWindow()->window_path)
                    ->with('windowPath', $this->activeWindow()->window_path)
                    ->with('windowName', $this->activeWindow()->window_name)
                    ->with('windowIcon', $this->activeWindow()->window_icon)
                    ->with('activeModule', $this->activeModule());
    }
}
