<?php 

namespace App\Http\Traits\Accounts;

use Hash;
use Crypt;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Model\Accounts\UsersCompanyAccess;
use App\Model\Accounts\UsersWindowMethodAccess;
use App\Model\Settings\SystemFileSystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersAccessAccountTrait
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
	        'cpassword' => 'min:6|required_with:npassword|same:cpassword',
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
	        'name'           => $request->firstname,
	        'middlename'     => $request->middlename,
	        'lastname'       => $request->lastname,
	        'email'          => $request->email,
	        'personal_email' => $request->email,
	        'education'      => $request->education,
	        'birth_date'     => $request->birth_date,
	        'position_title' => $request->position_title,
	        'personal_contact_phone' => $request->contact_no,
	        'personal_address' => $request->address,
	        'username'       => $request->username,
	        'password'       => bcrypt($request->cpassword),
	        'order_level'    => (new CommonService)->orderLevel((new User)),
	        'created_by'     => $this->thisUser()->users_id,
	        'created_date'   => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        'profile_path'   => null,
		];

		/* VALIDATE USERS IF EXISTS */
		$user = (new User)->where('firstname', $request->firstname)
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

		    request()->session()->flash('failed', $message);

		    return back()->withInput();

		} 

		if(count($user) > 0) {

		    request()->session()->flash('failed','This User or Email is already exists.');

		    return back()->withInput();

		} else {

		    $usersId = (new User)->insertGetId($array);

		    /* Creating Default Company Access*/
		    $compayAccess = [
		    	'users_id'     => $usersId,
		    	'company_id'   => $request->input('company'),
		    	'created_by'   => $this->thisUser()->users_id,
		    	'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		    ];

		    (new UsersCompanyAccess)->insert($compayAccess);

		    request()->session()->flash('success','New User successfully created.');
		    
		    return back();

		}
	}

	public function accounts_update_users_information($method, $id = null, $request)
	{	
		
		// $personalAddressID = (is_null($request->input('personal_address_id'))) ?
		// 				$this->accounts_create_address($request->input('personal_address'), decrypt($id)) : 
		// 				$request->input('personal_address_id') ;

	    (new User)->where('users_id', decrypt($id))->update([
	    	'firstname'               => $request->input('firstname'),
	    	'middlename'              => $request->input('middlename'),
	    	'lastname'                => $request->input('lastname'),
	    	'business_email'          => $request->input('email'),
	    	'business_contact_phone'  => $request->input('contact'),
	    	'personal_email'          => $request->input('email'),
	    	'personal_contact_phone'  => $request->input('contact'),
	    	'personal_birth_date'     => $request->input('birthdate'),
	    	'personal_address'     	  => $request->input('address'),
	    	'updated_by'              => $this->activeUser()->users_id,
	    	'updated_date'            => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	    ]);

	    // $billingAddressID = (is_null($request->input('billing_address_id'))) ?
	    // 				$this->accounts_create_address($request->input('billing_address'), decrypt($id)) : 
	    // 				$request->input('billing_address_id') ;

	    // app('UsersBilling')->where('users_id', decrypt($id))->update([
	    // 	'consumer_address'          => $billingAddressID,
	    // 	'consumer_description'      => $request->input('billing_description'),
	    // 	'consumer_tin'              => $request->input('billing_tin'),
	    // 	'consumer_tax_rate'         => $request->input('billing_tax_rate'),
	    // 	'consumer_currency'         => $request->input('billing_currency'),
	    // 	'consumer_website'          => $request->input('billing_website'),
	    // 	'consumer_email'            => $request->input('billing_email'),
	    // 	'consumer_contact_person'   => $request->input('billing_contact_person'),
	    // 	'consumer_contact_phone'    => $request->input('billing_contact_phone'),
	    // 	'consumer_contact_position' => $request->input('billing_contact_position'),
	    // 	'updated_by'                => $this->thisUser()->users_id,
	    // 	'updated_date'              => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	    // ]);

	    $request->session()->flash('success', 'Users Account Information successfully updated.');

	    return back();
	}

	public function accounts_create_address($address, $userID)
	{
		// $usersAddressCount = app('UsersBillingAddress')->where('users_id', $userID)->where('address_complete', $address)->first();

		// if(count($usersAddressCount) > 0) {
		// 	return $usersAddressCount->address_id;
		// } else {
		// 	$createAddress = app('UsersBillingAddress');

		// 	$createAddress->users_id = $userID;
		// 	$createAddress->address_complete = $address;

		// 	$createAddress->save();

		// 	return $createAddress->address_id;
		// }
	}

	public function accounts_update_users_profile_photo($method, $id = null, $request)
	{
    	if(collect($this->activeUser(decrypt($id)))->isNotEmpty()) {
    		/* Update Users Profile Photo */
        	(new User)->where('users_id', decrypt($id))->update([
				'profile_path' => $request->input('change_profile_image'),
				'updated_by'   => $this->activeUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			]);
        	/* Update Media Status */
			SystemFileSystem::where('file_path', $request->input('change_profile_image'))->update([
				'media_status' => 'used',
			]);

        	$request->session()->flash('success', 'Profile picture updated successfully.');
        	return back();

    	} else {
    		$request->session()->flash('failed', 'Invalid Users Account');
    		return back();
    	}
	}

	public function accounts_update_users_password($method, $id = null, $request)
	{
		$this->validate($request, $this->accounts_validate_users_password());

	    if (Hash::check($request->opassword, $this->activeUser(decrypt($id))->password)) {

	        if ($request->npassword == $request->cpassword) {

	            (new User)->where('users_id', decrypt($id))->update([
	            	'password' => bcrypt($request->cpassword), 
	            	'updated_by' => $this->activeUser()->users_id,
		            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	            ]);

	            $request->session()->flash('success', 'Password successfully updated.');

	            return back();

	        } else {

	            $request->session()->flash('failed', 'Password do not match with the confirmed password, Please try again.');

	            return back();
	        }

	    } else {

	        $request->session()->flash('failed', 'You have enterred invalid old password. Please try again.');

	        return back();
	    }
	}

	public function accounts_update_users_company_access($method, $id = null, $request)
	{

		if( !is_null($request->company ) ) {

			foreach ($request->company as $key => $value) {

				$companyAccess = (new UsersCompanyAccess)
										->where('access_users_id', decrypt($value['users_id']))
										->where('access_company_id', decrypt($value['company_id']))
										->delete();

			    if( array_key_exists('checkbox', $value) ) {

		    		$default = array_key_exists('default_id', $value) ? 1 : 0 ;

			        (new UsersCompanyAccess)->insert([
			        	'access_company_default' => $default,
			        	'access_users_id' => decrypt($value['users_id']), 
			        	'access_company_id' => decrypt($value['company_id']),
			        	'created_by' => $this->activeUser()->users_id,
			        	'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),  
			        ]);
				}
			}
		}
	}

	public function accounts_update_users_window_method_access($method, $id = null, $request)
	{
		if( !is_null($request->method) ) {
			foreach($request->method as $key => $value) {
				$methodAccess = (new UsersWindowMethodAccess)
									->where('users_id',   decrypt($id))
									->where('method_id',  decrypt($value['method_id']))
									->where('menu_id',    decrypt($value['menu_id']))
									->where('module_id',  decrypt($value['module_id']))
									->where('company_id', decrypt($value['company_id']));
				if( array_key_exists('checkbox', $value) ) { 
					if( count($methodAccess->first()) == 0 ) {
						(new UsersWindowMethodAccess)->insert([
							'access_users_id'   => decrypt($id),
							'access_window_method_id'  => decrypt($value['method_id']),
							'access_window_menu_id'    => decrypt($value['menu_id']),
							'access_module_id'  => decrypt($value['module_id']),
							'access_company_id' => decrypt($value['company_id']),
							'created_by' => $this->activeUser()->users_id,
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
	    if($this->activeUser()->users_id != decrypt($id)) {

	    	$collect = [
	            'status'       => $request->status,
	            'updated_by'   => $this->activeUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        ];

	        (new User)->where('users_id', decrypt($id))->update($collect);

	        return response()->json(['message' => 'Account successfully updated']);

	    } else {
	    	return response()->json(['message' => 'Cannot update your own account to Inactive.']);
	    }
	}

}