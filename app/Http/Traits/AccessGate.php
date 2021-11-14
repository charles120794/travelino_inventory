<?php

namespace App\Http\Traits;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Policies\SystemWindowAccessPolicy;
use App\Policies\SystemWindowAccessMethodPolicy;

trait AccessGate
{

	public function usersActionGate($path, $action = null, $id = null, Request $request)
	{
		/**
         * Check if request Has id parameter and exists in window method
         * Accepts false
         */
		if (!Gate::allows('window-method-not-exists')) {
            return 'Window action does not exist.';
        }

		/**
         * Check if request Has id parameter and exists in window method
         * Accepts false
         */
		// if (!Gate::allows('user-access-window-method')) {
        //     return 'User do not have the right to do this action.';
        // }

        return $this->proceed_to_action($request); 
	}

	public function usersAccessGate($path, $action = null, $id = null, Request $request)
	{	
		/**
		 * Deny if module do not exists
		 */
		if (!Gate::allows('module-not-exists')) {
            return 'Module does not exist.';
        }

        /**
         * Deny if use do not have the right to access this module
         */
		if (!Gate::allows('user-access-module')) {
            return 'User do not have the right to access this module.';
        }

        /**
		 * Deny if module do not exists
		 * Accepts false
		 */
		if (!Gate::allows('window-not-exists')) {
            return 'Window does not exist.';
        }

        /**
         * Deny if use do not have the right to access this module
         */
		if (!Gate::allows('user-access-window')) {
            return 'User do not have the right to access this window.';
        }
        
		return $this->proceed_to_action($request);

        // if($this->validateUsersModuleAccess()) {

        //     if(count($this->validateUsersWindowExists()) > 0) {

        //         if($this->validateUsersWindowAccess()) {

        //             if(!is_null(active_action()) && !is_null(active_id())) {

        //                 return $this->activemethod($request);
                        
        //             } else if (!is_null(active_action()) && is_null(active_id())) {

        //                 $window = $this->validateUsersWindowExists();

        //                 if(method_exists(app($window['window_trait']), $window['window_method'])) {

        //                     $method = $window->window_method;

        //                     return $this->$method($window);

        //                 } else {
        //                 	abort(403, 'Error #006 - The page you are looking for does not belong to this module.');
        //                     // Session::flash('failed','Error #006 - The page you are looking for does not belong to this module.');
        //                     // return back();
        //                 } 

        //             } else {
        //             	abort(403, 'Error #005 - Cannot Identify your action or no action is defined.');
        //             	// Session::flash('failed','Error #005 - Cannot Identify your action or no action is defined.');
        //             	// return back();
        //             }

        //         } else {
        //         	abort(403, 'Error #004 - You do not have permission to access this window.');
        //             // Session::flash('failed','Error #004 - You do not have permission to access this window.');
        //             // return back();
        //         }

        //     } else {
        //     	abort(403, 'Error #003 - The page you are looking for does not belong to this module.');
        //         // Session::flash('failed','Error #003 - The page you are looking for does not belong to this module.');
        //         // return back();
        //     }

        // } else {
        // 	abort(403, 'Error #002 - You do not have permission to access this module, Contact your system administrator for more info.');
        //     // Session::flash('failed','Error #002 - You do not have permission to access this module, Contact your system administrator for more info.');
        //     // return back();
        // }
	}

	protected function proceed_to_action($request)
	{
		if( !empty(active_path()) &&  empty(active_action()) ) {
			
			$window = $this->activeWindow();
			$action = $window->window_method;

			return $this->$action($window);
		}

		if( !empty(active_path()) && !empty(active_action()) ) { 

			$method = (new SystemWindowAccessMethodPolicy)->windowMethod();
			$action = $method->window_method_action;

			return $this->$action($method, active_id(), $request);
		}
	}

	public function activemethod($request)
	{
	    $usersWindowMethod = $this->validateUsersWindowExists()->subClassMethod()
								->where('window_name', active_action())
								->where('status','1')
								->first();

		if(collect($usersWindowMethod)->isEmpty()) {
			return abort(403, 'Window\'s method does not exist. Contact your system administrator to fix this issue.');
		}

		if($usersWindowMethod['window_type'] == 'common') {

	    	return $this->proceedToMethodAccess($usersWindowMethod);

		} else if($this->validateUsersWindowMethodAccess()) {

	    	return $this->proceedToMethodAccess($usersWindowMethod);

	    } else {

	    	return abort(403, 'Role Access Failed: You do not have permission to proceed.');
	    	// Session::flash('failed','Role Access Failed: You do not have permission to proceed.');
	    	// return back();
	    }
	}

	public function proceedToMethodAccess($method)
	{
    	if(method_exists(app($method['method_traits']), $method['method_function'])) {   

			$function = $method['method_function'];

			return $this->$function($method, active_id(), request());
    	    
    	} else {
    		return abort(403, 'Role Access Failed: The page you are looking for does not belong to this module.');
    	    // Session::flash('failed','Role Access Failed: The page you are looking for does not belong to this module.');
    	    // return back();
    	}
	}

	public function validateUsersModuleAccess()
	{
	    $usersActiveModule = $this->usersAllModule($this->thisUser()->users_id, $this->thisUser()->company_id);

	    $usersModuleAccess = array_pluck($usersActiveModule,'module_prefix');
	    
    	return ( count($usersActiveModule ) > 0 ) ? in_array(active_module(), $usersModuleAccess) : false ;
	}

	public function validateUsersWindowExists()
	{
		$module = $this->getModulePrefix();

	    return app('SystemWindow')->where('menu_path', active_path())->where('module_id', $module->module_id)->first();
	}

	public function validateUsersWindowAccess()
	{
		$usersActiveWindow = $this->usersActiveWindow($this->thisUser());

	    $usersWindowAccess = array_pluck($usersActiveWindow, 'menu_path');

    	return (count($usersActiveWindow) > 0 ) ? in_array(active_path(), $usersWindowAccess) : false ;
	}

	public function validateUsersWindowMethodAccess() 
	{
	    $usersActiveWindowMethod = $this->usersActiveWindowMethod($this->thisUser());
	    
	    $usersWindowAccess = array_pluck($usersActiveWindowMethod,'method_name');
	    
    	return (count($usersActiveWindowMethod) > 0 ) ? in_array(active_action(), $usersWindowAccess) : false ;
	}

}
