<?php

namespace App\Http\Traits\Accounts;

use Session;
use Illuminate\Http\Request;
use App\Model\Accounts\UsersWindowAccess;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersAccessWindowTrait 
{	

	public function accounts_update_users_window_access($method, $id, $request) 
	{

		if( !is_null($request->window ) ) {

		    foreach( $request->window as $key => $value ) {

		    	$windowAccess = (new UsersWindowAccess)
						->where('menu_id',     decrypt($value['menu_id']))
						->where('users_id',    decrypt($value['users_id']))
						->where('module_id',   decrypt($value['module_id']))
						->where('company_id',  decrypt($value['company_id']));

		    	if( array_key_exists( 'checkbox' , $value ) ) {

		        	if( $windowAccess->count() == 0 ) {

                		(new UsersWindowAccess)->insert([ 

	                		'menu_id'      => decrypt($value['menu_id']), 
	                		'users_id'     => decrypt($value['users_id']),
	                		'module_id'    => decrypt($value['module_id']),
	                		'menu_type'    => decrypt($value['menu_type']),
	                		'company_id'   => decrypt($value['company_id']),
	                		'menu_parent'  => decrypt($value['menu_parent']),
	                		'order_level'  => decrypt($value['order_level']),
	                		'menu_name'    => $value['menu_name'],

	                		'created_by'   => $this->thisUser()->users_id,
							'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
                		]);
		            }

		        } else {

	                $windowAccess->delete(); 
		        }
		    }
		}
	}

	public function accounts_update_users_window_access_reorder($method, $id, $request) 
	{

		if( !is_null($request->group ) ) {

		    foreach( $request->group as $key => $value ) {

		    	app('UsersWindowAccess')->where('access_id', $key)->update([
		    		'menu_parent' => $value['parent'],
		    		'menu_level'  => $value['level'],
		    		'menu_type'   => $value['type'],
		    		'menu_name'   => $value['description'],
		    		'order_level' => $value['order'],
		    	]);
		    }
		}

		$request->session()->flash('success','User Window Access successfully updated');

		return back();
	}

	public function accounts_delete_users_window_access($method, $id = null, $request)
	{
		UsersWindowAccess::findOrFail(decrypt($id))->delete();

		request()->session()->flash('success', 'Users Window successfully deleted.');

		return back();
	}
}