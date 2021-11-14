<?php

namespace App\Policies;

use App\User;
use App\Model\Settings\SystemWindowMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemWindowAccessMethodPolicy
{
    use HandlesAuthorization;
    
    public function windowMethodNotExists()
    {
        return ( empty(active_action()) ) 

            ? true : collect($this->windowMethod())->isNotEmpty() ;
    }

    public function userAccessWindowMethod()
    {
        $windowMethod = $this->windowMethod();

        return ( empty(active_action()) ) 

            ? true : in_array( $windowMethod['window_method_code'], Auth()->User()->windowMethodAccess->pluck('access_window_method_code')->toArray()) ;
    }

    public function windowMethod()
    {
        return SystemWindowMethod::where('window_method_name', active_action())->first();
    }
}
