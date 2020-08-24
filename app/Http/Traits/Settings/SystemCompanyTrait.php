<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemCompanyTrait
{
    /* Inputs Validation */
    protected function settings_company_rules()
    {
        return [
            'company_logo' => 'mimes:'.$this->validatefile('I'),
            'company_cover_photo' => 'mimes:'.$this->validatefile('I'),
        ];
    }

    public function settings_create_system_company($method, $id = null, $request)
    {

        $exists_count = app('SystemCompany')->where('company_code', $request->company_code)
                        ->where('company_name', $request->company_name)
                        ->where('company_description', $request->company_description)
                        ->first();

        $array = [
            'company_code' => strtoupper($request->company_code),
            'company_name' => strtoupper($request->company_name),
            'company_description' => strtoupper($request->company_description),
            'company_email' => $request->company_email,
            'company_tagline' => strtoupper($request->company_tagline),
            'company_location' => strtoupper($request->company_location),
            'company_address' => strtoupper($request->company_address),
            'company_contact_phone' => $request->company_contact_phone,
            'company_contact_number' => $request->company_contact_number,
            'company_registered_owner' => strtoupper($request->company_registered_owner),
            'company_foundation' => $request->company_foundation,
            'company_license_no' => $request->company_license_no,
            'company_max_users' => $request->company_max_users,
            'company_facebook' => $request->company_facebook,
            'company_twitter' => $request->company_twitter,
            'company_pinterest' => $request->company_pinterest,
            'company_instagram' => $request->company_instagram,
            'created_by' => $this->thisUser()->users_id,
            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if(count($exists_count) > 0) {

            Session::flash('failed','This company code, name or description is already exists.');
            return back()->withInput();

        } else {

            $insert_get_company_id = app('SystemCompany')->insertGetId($array);

            if($insert_get_company_id > 0) {

                foreach ($request->modules as $module_id => $value) {

                    if($value['company_module'] == 'on') {

                        app('SystemCompanyModule')->insert([
                            'module_id'    => $module_id,
                            'company_id'   => $insert_get_company_id,
                            'created_by'   => $this->thisUser()->users_id,
                            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
                        ]);

                    }

                }

                Session::flash('success','New Company successfully created');
                return back();

            } else {

                Session::flash('failed','An Error occur when generating data, Please try again');
                return back()->withInput();

            }

        }

    }

    public function settings_update_system_company($method, $id = null, $request)
    {

        $exists_count = app('SystemCompany')->where('company_id', decrypt($id));

        $array = [
            'company_name' => strtoupper($request->company_name),
            'company_description' => strtoupper($request->company_description),
            'company_email' => $request->company_email,
            'company_tagline' => strtoupper($request->company_tagline),
            'company_location' => strtoupper($request->company_location),
            'company_address' => strtoupper($request->company_address),
            'company_contact_phone' => $request->company_contact_phone,
            'company_contact_number' => $request->company_contact_number,
            'company_registered_owner' => strtoupper($request->company_registered_owner),
            'company_foundation' => $request->company_foundation,
            'company_license_no' => $request->company_license_no,
            'company_max_users' => $request->company_max_users,
            'company_facebook' => $request->company_facebook,
            'company_twitter' => $request->company_twitter,
            'company_pinterest' => $request->company_pinterest,
            'company_instagram' => $request->company_instagram,
            'updated_by' => $this->thisUser()->users_id,
            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if($exists_count->count() > 0) {
            /* Update Companny Information */
            $exists_count->update($array);
            /* Delete All Existing Company Module */
            $delete_all_company_module = app('SystemCompanyModule')->where('company_id', decrypt($id))->delete();
            /* Rewrite all Company Module */
            if($delete_all_company_module >= 0) {

                foreach ($request->modules as $module_id => $value) {

                    if($value['company_module'] == 'on') {

                        app('SystemCompanyModule')->insert([
                            'module_id'    => $module_id,
                            'company_id'   => decrypt($id),
                            'created_by'   => $this->thisUser()->users_id,
                            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
                        ]);

                    }

                }

            }

        }

        Session::flash('success','Company successfully updated.');
        return back();

    }

    public function settings_delete_system_company($method, $id = null, $request)
    {

        $count_company_users = app('UsersCompanyAccess')->where('company_id', decrypt($id))->count();

        if($count_company_users > 0) {

            Session::flash('failed','Cannot delete Company wiht an existing Users.');
            return back();

        } else {

            app('SystemCompany')->where('company_id', decrypt($id))->delete();

            app('SystemCompanyModule')->where('company_id', decrypt($id))->delete();

            Session::flash('success','Company successfully deleted.');
            return back();

        }
        
    }

    public function settings_toggle_system_company($method, $id = null, $request)
    {
        
    }
    
}
