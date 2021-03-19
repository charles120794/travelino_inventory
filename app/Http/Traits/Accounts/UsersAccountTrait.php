<?php 

namespace App\Http\Traits\Accounts;

use Hash;
use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Model\Settings\SystemMedia;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersAccountTrait
{

	public function accounts_validate_users_information()
	{
		return [
			'company'    => 'required',
			'firstname'  => 'required',
			'middlename' => 'required',
			'lastname'   => 'required',
			'email'      => 'required',
			'birth_date' => 'required',
			'education'  => 'required',
			'contact_no' => 'required',
			'address'    => 'required',
			'position_title' => 'required',
		];
	}

	public function accounts_validate_users_password()
	{
		return [
	        'npassword' => 'min:6',
	        'npassword' => 'min:6',
	        'cpassword' => 'min:6|required_with:npassword|same:npassword',
		];
	}
	
	public function accounts_create_users_account($method, $id = null, $request)
	{
		$this->validate($request, $this->accounts_validate_users_information());

		$this->validate($request, $this->accounts_validate_users_password());

		$compute_age = ((new CommonService)->dateTimeToday('Y') - date('Y', strtotime($request->birth_date)));
	
		$array = [
			'company_id'     => $request->company,
	        'firstname'      => $request->firstname,
	        'middlename'     => $request->middlename,
	        'lastname'       => $request->lastname,
	        'email'          => $request->email,
	        'birthdate'      => $request->birth_date,
	        'education'      => $request->education,
	        'position_title' => $request->position_title,
	        'contact'        => $request->contact_no,
	        'address'        => $request->address,
	        'username'       => $request->username,
	        'password'       => bcrypt($request->cpassword),
	        'age'            => $compute_age,
	        'order_level'    => (new CommonService)->orderLevel(app('Users')),
	        'created_by'     => $this->thisUser()->users_id,
	        'created_date'   => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        'profile_path'   => null,
		];

		/* VALIDATE USERS IF EXISTS */
		$user = app('Users')->where('firstname', $request->firstname)
							->where('middlename', $request->lastname)
							->where('lastname', $request->lastname)
							->where('email', $request->email)
		                    ->first();

		/* VALIDATE COMPANY IF MAX USERS EXCEEDS */
		/* Count Exixting User */
		$count_exist_users = count($this->companyUsers($request->input('company')));
		/* Check Company Max Users */
		$count_company_max_user = $this->getCompany($request->input('company'))->company_max_users;

		if($count_company_max_user <= $count_exist_users) {

		    $message ='Cannot add new user. This company (' . $company->company_descriptiion . ') reached the maximum number of users.';

		    Session::flash('failed', $message);
		    return back()->withInput();

		} 

		if(count($user) > 0) {

		    Session::flash('failed','This User or Email is already exists.');
		    return back()->withInput();

		} else {

		    $usersId = app('Users')->insertGetId($array);

		    /* Creating Default Company Access*/
		    $compayAccess = [
		    	'users_id'     => $usersId,
		    	'company_id'   => $request->input('company'),
		    	'created_by'   => $this->thisUser()->users_id,
		    	'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		    ];

		    app('UsersCompanyAccess')->insert($compayAccess);

		    Session::flash('success','New User successfully created.');
		    return back();

		}
	}

	public function accounts_update_users_information($method, $id = null, $request)
	{	
	
		$personalAddressID = (is_null($request->input('personal_address_id'))) ?
						$this->accounts_create_address($request->input('personal_address'), decrypt($id)) : 
						$request->input('personal_address_id') ;

	    app('Users')->where('users_id', decrypt($id))->update([
	    	'firstname'               => $request->input('firstname'),
	    	'middlename'              => $request->input('middlename'),
	    	'lastname'                => $request->input('lastname'),
	    	'business_email'          => $request->input('contact_business_email'),
	    	'business_contact_phone'  => $request->input('contact_business_phone'),
	    	'personal_email'          => $request->input('contact_personal_email'),
	    	'personal_contact_phone'  => $request->input('contact_personal_phone'),
	    	'personal_address_id'     => $personalAddressID,
	    	'birth_date'              => $request->input('personal_birth_date'),
	    	'updated_by'              => $this->thisUser()->users_id,
	    	'updated_date'            => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	    ]);

	    $billingAddressID = (is_null($request->input('billing_address_id'))) ?
	    				$this->accounts_create_address($request->input('billing_address'), decrypt($id)) : 
	    				$request->input('billing_address_id') ;

	    app('UsersBilling')->where('users_id', decrypt($id))->update([
	    	'consumer_address'          => $billingAddressID,
	    	'consumer_description'      => $request->input('billing_description'),
	    	'consumer_tin'              => $request->input('billing_tin'),
	    	'consumer_tax_rate'         => $request->input('billing_tax_rate'),
	    	'consumer_currency'         => $request->input('billing_currency'),
	    	'consumer_website'          => $request->input('billing_website'),
	    	'consumer_email'            => $request->input('billing_email'),
	    	'consumer_contact_person'   => $request->input('billing_contact_person'),
	    	'consumer_contact_phone'    => $request->input('billing_contact_phone'),
	    	'consumer_contact_position' => $request->input('billing_contact_position'),
	    	'updated_by'                => $this->thisUser()->users_id,
	    	'updated_date'              => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	    ]);

	    Session::flash('success', 'Users Account Information successfully updated.');
	    return back();
	}

	protected function accounts_create_address($address, $userID)
	{
		$usersAddressCount = app('UsersBillingAddress')->where('users_id', $userID)->where('address_complete', $address)->first();

		if(count($usersAddressCount) > 0) {
			return $usersAddressCount->address_id;
		} else {
			$createAddress = app('UsersBillingAddress');

			$createAddress->users_id = $userID;
			$createAddress->address_complete = $address;

			$createAddress->save();

			return $createAddress->address_id;
		}
	}

	public function accounts_update_users_profile_photo($method, $id = null, $request)
	{
    	if(count($this->getUser($id)) > 0) {
    		/* Update Users Profile Photo */
        	app('Users')->where('users_id', decrypt($id))->update([
				'profile_path' => $request->input('change_profile_image'),
				'updated_by' => $this->thisUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			]);
        	/* Update Media Status */
			SystemMedia::where('media_path', $request->input('change_profile_image'))->update([
				'media_status' => 'used',
			]);

        	Session::flash('success', 'Profile picture updated successfully.');
        	return back();

    	} else {
    		Session::flash('failed', 'Invalid Users Account');
    		return back();
    	}
	}

	public function accounts_update_users_password($method, $id = null, $request)
	{
		$this->validate($request, $this->accounts_validate_users_password());

	    if (Hash::check($request->opassword, $this->thisUser(decrypt($id))->password)) {

	        if ($request->npassword == $request->cpassword) {

	            app('Users')->where('users_id', decrypt($id))->update([
	            	'password' => bcrypt($request->cpassword), 
	            	'updated_by' => $this->thisUser()->users_id,
		            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	            ]);

	            Session::flash('success', 'Password successfully updated.');
	            return back();

	        } else {
	            Session::flash('failed', 'Password do not match with the confirmed password, Please try again.');
	            return back();
	        }

	    } else {
	        Session::flash('failed', 'You have enterred invalid old password. Please try again.');
	        return back();
	    }
	}

	public function accounts_update_users_company_access($method, $id = null, $request)
	{
		if( !is_null($request->company ) ) {
			foreach ($request->company as $key => $value) {
				$companyAccess = app('UsersCompanyAccess')
					->where('users_id', decrypt($value['users_id']))
					->where('company_id', decrypt($value['company_id']));
			    if( array_key_exists('checkbox', $value) ) {
			    	if( count($companyAccess->first()) == 0 ) {
				        app('UsersCompanyAccess')->insert([
				        	'users_id' => decrypt($value['users_id']), 
				        	'company_id' => decrypt($value['company_id']),
				        	'created_by' => $this->thisUser()->users_id,
				        	'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),  
				        ]);
				    } 
				} else {
					$companyAccess->delete();
				}
			}
		}
	}

	public function accounts_update_users_window_access($method, $id = null, $request) 
	{
		if( !is_null($request->window ) ) {
		    foreach( $request->window as $key => $value ) {
		    	$windowAccess = app('UsersWindowAccess')
						->where('users_id',    decrypt($value['users_id']))
						->where('company_id',  decrypt($value['company_id']))
						->where('module_id',   decrypt($value['module_id']))
						->where('menu_id',     decrypt($value['menu_id']));
		    	if( array_key_exists( 'checkbox' , $value ) ) {
		        	if( $windowAccess->count() == 0 ) {
		        		$array = [ 
	                		'users_id'     => decrypt($value['users_id']),
	                		'company_id'   => decrypt($value['company_id']),
	                		'module_id'    => decrypt($value['module_id']),
	                		'menu_id'      => decrypt($value['menu_id']), 
	                		'menu_type'    => decrypt($value['menu_type']),
	                		'menu_parent'  => decrypt($value['menu_parent']),
	                		'created_by'   => $this->thisUser()->users_id,
							'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
                		];
                		app('UsersWindowAccess')->insert($array);
		            }
		        } else {
	                $windowAccess->delete(); 
		        }
		    }
		}
	}

	public function accounts_update_users_window_access_reorder($method, $id = null, $request) 
	{
		if( !is_null($request->group ) ) {
		    foreach( $request->group as $key => $value ) {
		    	app('UsersWindowAccess')->where('access_id', $key)->update([
		    		'menu_parent' => $value['parent'],
		    		'menu_level'  => $value['level'],
		    		'menu_type'   => $value['type'],
		    		'order_level' => $value['order'],
		    	]);
		    }
		}
		$request->session()->flash('success','User Window Access successfully updated');
		return back();
	}

	public function accounts_update_users_window_method_access($method, $id = null, $request)
	{
		if( !is_null($request->method) ) {
			foreach($request->method as $key => $value) {
				$methodAccess = app('UsersWindowMethodAccess')
									->where('users_id',   decrypt($id))
									->where('method_id',  decrypt($value['method_id']))
									->where('menu_id',    decrypt($value['menu_id']))
									->where('module_id',  decrypt($value['module_id']))
									->where('company_id', decrypt($value['company_id']));
				if( array_key_exists('checkbox', $value) ) { 
					if( count($methodAccess->first()) == 0 ) {
						app('UsersWindowMethodAccess')->insert([
							'users_id'   => decrypt($id),
							'method_id'  => decrypt($value['method_id']),
							'menu_id'    => decrypt($value['menu_id']),
							'module_id'  => decrypt($value['module_id']),
							'company_id' => decrypt($value['company_id']),
							'created_by' => $this->thisUser()->users_id,
							'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
						]);
					}
				} else {
					$methodAccess->delete(); /* DELETE IF EXISTS BUT NOT SELECTED */
				}
			}
			return ['message' => 'Users Window Method Access successfully updated.'];
		} else {
			return ['message' => 'Invalid request of method. Please try again.'];
		}
	}

	public function accounts_toggle_users_account($method, $id = null, $request)
	{
	    if($this->thisUser()->users_id != decrypt($id)) {
	        app('Users')->where('users_id', decrypt($id))->update([
	            'status' => $request->status,
	            'updated_by' => $this->thisUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        ]);
	        return response()->json(['message' => 'Account successfully updated']);
	    } else {
	    	return response()->json(['message' => 'Cannot update your own account to Inactive.']);
	    }
	}

	public function accounts_delete_users($method, $id = null, $request)
	{
		
	}

}