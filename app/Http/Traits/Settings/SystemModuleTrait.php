<?php

namespace App\Http\Traits\Settings;

use Storage;
use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemModuleTrait
{

	protected function settings_validate_module_inputs()
	{
		return [
			'module_code' => 'required',
			'module_name' => 'required',
			'module_description' => 'required',
		];
	}

	public function settings_create_system_module($method, $id = null, $request, $message = '')
	{

		$this->validate($request,$this->settings_validate_module_inputs());
		
		$arrays = [
			'module_code' => $request->module_code,
			'module_name' => $request->module_name,
			'module_description' => $request->module_description,
			'order_level'  => (new CommonService)->orderLevel(app('SystemModule')),
			'created_by'   => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$created = app('SystemModule')->insert($arrays);

		if($created > 0) {

			Session::flash('success','New module successfully created');
			return back();

		} else {

			Session::flash('success','Whoops! Something wrong during the process, Please try again.');
			return back();

		}
		
	}

	public function settings_update_system_module($method, $id = null, $request)
	{
		$check_if_exists = app('SystemModule')->where('module_id', decrypt($id));

		if($check_if_exists->count() > 0) {

			$check_if_exists->update([
				// 'module_code' => $request->input('module_code'),
				'module_name' => $request->input('module_name'),
				'module_description' => $request->input('module_description'),
				'updated_by' => $this->thisUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			]);

			Session::flash('success','Module successfully updated.');
			return back();

		} else {

			Session::flash('failed','No data has been found to update. Please try again.');
			return back();

		}
	}

	public function settings_toggle_system_module($method, $id = null, $request)
	{
		$exists_count = app('UsersModuleAccess')->where('module_id', decrypt($id))->get();

		if(count($exists_count) == 0) {
			return app('SystemModule')->where('module_id', decrypt($id))->update(['status' => $request->status]);
		}
	}

	public function settings_delete_system_module($method, $id = null, $request)
	{
		
		$usersss_count = app('UsersModuleAccess')->where('module_id', decrypt($id));

		$company_count = app('SystemCompanyModule')->where('module_id', decrypt($id));

		$windows_count = app('SystemWindow')->where('module_id', decrypt($id));

		$methods_count = app('SystemWindowMethod')->where('module_id', decrypt($id));

		if($usersss_count->count() > 0 || $company_count->count() > 0 || $windows_count->count() > 0 || $methods_count->count() > 0) {

			Session::flash('failed','Cannnot delete module because it is still in use.');
			return back();

		} else {

			app('SystemModule')->where('module_id', decrypt($id))->delete();

			Session::flash('success','Module successfully deleted.');
			return back();

		}
		
	}

}
