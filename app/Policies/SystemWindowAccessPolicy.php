<?php

namespace App\Policies;

use App\User;
use App\Model\Settings\SystemWindow;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Http\Traits\Retrieves\SystemModuleTrait;

class SystemWindowAccessPolicy
{
    use HandlesAuthorization, SystemModuleTrait;
    
    public function windowNotExists()
    {
        return ( empty(active_path()) ) 

            ? true : collect($this->window())->isNotEmpty() ;
    }

    public function userAccessWindow()
    {
        $window = $this->window();

        $usersWindow = Auth()->User()->windowAccess->pluck('access_window_code')->toArray();

        return ( empty(active_path()) ) 

            ? true : in_array($window['window_code'], $usersWindow) ;
    }

    public function window()
    {
        $activeModule = $this->activeModule();

        return SystemWindow::where('window_module_id', $activeModule->module_id)->where('window_path', active_path())->first();
    }
}
