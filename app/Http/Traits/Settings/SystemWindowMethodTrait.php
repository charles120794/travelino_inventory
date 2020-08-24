<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemWindowMethodTrait
{
	public function settings_create_window_method($method, $id = null, $request)
	{
		$systemMethod = app('SystemWindowMethod');
		$systemMethod->menu_id = (!is_null($request->menu_child)) ? $request->menu_child : $request->menu_parent;
		$systemMethod->method_request = $request->request_type;
		$systemMethod->method_name = strtolower($request->method_name);
		$systemMethod->method_function = str_replace('-', '_', strtolower($request->method_name));
		$systemMethod->method_blade = null;
		$systemMethod->method_traits = null;
		$systemMethod->created_by = $this->thisUser()->users_id;
		$systemMethod->created_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

		if( $systemMethod->save() ) {
			Session::flash('success','New method successfully inserted.');
			return back();
		} else {
			Session::flash('failed','Unable to save new data, Please try again.');
			return back();
		}
	}

	public function settings_update_window_method($method, $id = null, $request)
	{

	}

	public function settings_delete_window_method($method, $id = null, $request)
	{
	
	}
}