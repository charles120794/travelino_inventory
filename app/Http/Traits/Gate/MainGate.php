<?php

namespace App\Http\Traits\Gate;

use Storage;
use Session;
use Illuminate\Http\Request;

trait MainGate
{

	public function activeAdmin($path , $action = null, $id = null, Request $request)
	{

        if($this->validateUsersModuleAccess()) {

            if(count($this->validateUsersWindowExists()) > 0) {

                if($this->validateUsersWindowAccess()) {

                    if(!is_null(active_action()) && !is_null(active_id())) {

                        return $this->activemethod($request);
                        
                    } else if (!is_null(active_action()) && is_null(active_id())) {

                        $window = $this->validateUsersWindowExists();

                        if(method_exists(app($window['menu_trait']), $window['menu_method'])) {

                            $method = $window->menu_method;

                            return $this->$method($window);

                        } else {
                            Session::flash('failed','Error #006 - The page you are looking for does not belong to this module.');
                            return back();
                        } 

                    } else {
                    	Session::flash('failed','Error #005 - Cannot Identify your action or no action is defined.');
                    	return back();
                    }

                } else {
                    Session::flash('failed','Error #004 - You do not have permission to access this window.');
                    return back();
                }

            } else {
                Session::flash('failed','Error #003 - The page you are looking for does not belong to this module.');
                return back();
            }

        } else {
            Session::flash('failed','Error #002 - You do not have permission to access this module, Contact your system administrator for more info.');
            return back();
        }

	}

	public function activemethod($request)
	{
	
	    if($this->validateUsersWindowMethodAccess()) {

    	    $windowMethod = $this->validateUsersWindowExists()->subClassMethod()
    								->where('method_name', active_action())
    								->where('status','1')
    								->first();

	    	if(method_exists(app($windowMethod->method_traits), $windowMethod->method_function)) {   

    			$method = $windowMethod->method_function;

    			return $this->$method($windowMethod, active_id(), $request);
	    	    
	    	} else {
	    	    Session::flash('failed','Role Access Failed: The page you are looking for does not belong to this module.');
	    	    return back();
	    	}

	    } else {
	    	Session::flash('failed','Role Access Failed: You do not have permission to proceed.');
	    	return back();
	    }

	}

	public function validateUsersModuleAccess()
	{
	    $usersActiveModule = $this->usersAllModule($this->thisUser()->users_id, $this->thisUser()->company_id);

	    $usersModuleAccess = array_pluck($usersActiveModule,'module_prefix');

	    if(active_module() == 'common') {
	    	return true;
	    } else {
	    	return ( count($usersActiveModule ) > 0 ) ? in_array(active_module(), $usersModuleAccess) : false ;
	    }
	}

	public function validateUsersWindowExists()
	{
		$moduleId = $this->getModulePrefix()->module_id;

	    return app('SystemWindow')->where('menu_path', active_path())->where('module_id', $moduleId)->first();
	}

	public function validateUsersWindowAccess()
	{
		$usersActiveWindow = $this->usersActiveWindow($this->thisUser());

	    $usersWindowAccess = array_pluck($usersActiveWindow, 'menu_path');

	    if(active_module() == 'common') {
	    	return true;
	    } else {
	    	return (count($usersActiveWindow) > 0 ) ? in_array(active_path(), $usersWindowAccess) : false ;
	    }
	}

	public function validateUsersWindowMethodAccess() 
	{
	    $usersActiveWindowMethod = $this->usersActiveWindowMethod($this->thisUser());
	    /* Collecting all users active window method in array type */
	    $usersWindowAccess = array_pluck($usersActiveWindowMethod,'method_name');
	    /* By passing all Common Functions */
	    if(active_module() == 'common') {
	    	return true;
	    } else {
	    	return (count($usersActiveWindowMethod) > 0 ) ? in_array(active_action(), $usersWindowAccess) : false ;
	    }
	}

}
