<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemCompanyModuleAccessTrait
{
	public function settings_update_company_module_access($method, $id = null, $request)
	{

		if( !is_null($request->module ) ) {

			foreach ($request->module as $key => $value) {

				$moduleAccess = app('CompanyModuleAccess')
			    					->where('module_id',  decrypt($value['module_id']))
			    					->where('company_id', decrypt($value['company_id']));

			    if( array_key_exists('checkbox', $value) ) {

			    	if( count($moduleAccess->first()) == 0 ) {

				        app('CompanyModuleAccess')->insert([ 	
			        		'module_id'  => decrypt($value['module_id']),
			        		'company_id' => decrypt($value['company_id']), 
			        		'created_by' => $this->thisUser()->users_id,
			        		'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'), 
				        ]);

				    } 

				} else {
					$moduleAccess->delete();
				}

			}

		}

	}

}