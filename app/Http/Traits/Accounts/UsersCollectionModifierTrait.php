<?php

namespace App\Http\Traits\Accounts;

use Illuminate\Http\Request;

trait UsersCollectionModifierTrait
{
    public function accounts_search_users_module_json($method, $id = null, $request)
    {
        return response()->json($this->usersAllModule(decrypt($id), $request->company_id));
    }

    public function accounts_search_users_window_json($method, $id = null, $request)
    {
    	return response()->json($this->usersAllWindow(decrypt($id), $request->company_id, $request->module_id));
    }

    public function accounts_search_company_module_json($method, $id = null, $request)
    {   
        return response()->json($this->companyModule($request->company_id));
    }

    public function accounts_search_users_company_module_json($method, $id = null, $request)
    {
    	return response()->json($this->usersAllModule(decrypt($id), $request->company_id));
    }
}
