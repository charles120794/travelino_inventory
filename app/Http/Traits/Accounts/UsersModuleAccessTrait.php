<?php 

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersModuleAccessTrait
{
	public function accounts_update_users_module_access($method, $id = null, $request)
	{
		
		if( !is_null($request->module ) ) {

			foreach ($request->module as $key => $value) {

				$moduleAccess = app('UsersModuleAccess')
						->where('users_id', decrypt($id))
						->where('module_id', decrypt($value['module_id']))
						->where('company_id', decrypt($value['company_id']));

			    if( array_key_exists('checkbox', $value) ) {

			    	if( count($moduleAccess->first()) == 0 ) {

				        app('UsersModuleAccess')->insert([ 	
			        		'users_id' => decrypt($id), 
			        		'module_id' => decrypt($value['module_id']),
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