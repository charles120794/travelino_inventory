<?php

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait UsersMethodLoaderTrait
{
    /* Search Tables */
    public function accounts_search_users_company_table($method, $id = null, $request)
    {
        $usersCompany    = $this->usersCompany(decrypt($id))->pluck('company_id')->toArray();
        $usersDefaultCompany  = $this->usersDefaultCompany(decrypt($id))->company_id;
        $systemCompany   = $this->allActiveCompany();
        $thisUserAccount = $this->activeUser(decrypt($id));
        $thisUserCompany = $this->activeCompany();

        return $this->myViewMethodLoader($method)
                            ->with('usersCompany', $usersCompany)
                            ->with('systemCompany', $systemCompany)
                            ->with('thisUserAccount', $thisUserAccount)
                            ->with('thisUserCompany', $thisUserCompany)
                            ->with('usersDefaultCompany', $usersDefaultCompany);
    }

    public function accounts_search_users_module_table($method, $id = null, $request)
    {
        $activeUser  = $this->activeUser(decrypt($id));
        $companyId   = $this->usersDefaultCompany(decrypt($id))->company_id;
        $usersModule = $this->usersModule(decrypt($id), $this->usersDefaultCompany(decrypt($id))->company_id);

        return $this->myViewMethodLoader($method)
                    ->with('companyId', $companyId)
                    ->with('activeUser', $activeUser)
                    ->with('usersModule', $usersModule);
    }

    public function accounts_search_users_window_table($method, $id = null, $request)
    {
        $thisUserAcct = $this->activeUser($id);
        $moduleWindow = $this->systemWindow($request->module_id);
        $windowAccess = $this->getUserWindowAccess(decrypt($id), $request->company_id, $request->module_id);

        return $this->myViewMethodLoader($method)
                    ->with('moduleId', $request->module_id)
                    ->with('companyId', $request->company_id)
                    ->with('allWindow', $moduleWindow)
                    ->with('windowAccess', $windowAccess)
                    ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_search_users_window_method_table($method, $id = null, $request)
    {
        $thisUserAccou = $this->activeUser(decrypt($id));
        $moduleMethods = $this->moduleWindowMethod($request->module_id, $request->window_id);
        $usersMethodAc = $this->getUserWindowMethodAccess(decrypt($id), $request->company_id, $request->module_id, $request->window_id);

        return $this->myViewMethodLoader($method)
                ->with('companyId', $request->company_id)
                ->with('moduleId', $request->module_id)
                ->with('allMethods', $moduleMethods)
                ->with('methodAccess', $usersMethodAc)
                ->with('thisUserAccount', $thisUserAccou);
    }

    /* Display Views */
    public function accounts_users_user_profile($method, $id = null, $request)
    {
        $activeUser = $this->activeUser(decrypt($id));
        $activeUserCompany = $this->usersDefaultCompany(decrypt($id));

        return $this->myViewMethodLoader($method)
                ->with('thisUserAccount', $activeUser)
                ->with('thisUserCompany', $activeUserCompany);
    }

    public function accounts_users_user_company($method, $id = null, $request)
    {
        $usersCompany    = $this->usersCompany(decrypt($id))->pluck('company_id')->toArray();
        $usersDefaultCompany  = $this->usersDefaultCompany(decrypt($id))->company_id;
        $systemCompany   = $this->allActiveCompany();
        $thisUserAccount = $this->activeUser(decrypt($id));
        $thisUserCompany = $this->activeCompany();

        return $this->myViewMethodLoader($method)
                            ->with('usersCompany', $usersCompany)
                            ->with('systemCompany', $systemCompany)
                            ->with('thisUserAccount', $thisUserAccount)
                            ->with('thisUserCompany', $thisUserCompany)
                            ->with('usersDefaultCompany', $usersDefaultCompany);
    }

    public function accounts_users_user_module($method, $id = null, $request)
    {
        $thisUserAcct = $this->activeUser(decrypt($id));
        $usersCompany = $this->usersAllCompany(decrypt($id));
        $companyModul = $this->companyModule($this->usersDefaultCompany(decrypt($id))->company_id);
        $moduleAccess = $this->usersModule(decrypt($id), $this->usersDefaultCompany(decrypt($id))->company_id);

        return $this->myViewMethodLoader($method)
                            ->with('companyId', $thisUserAcct->company_id)
                            ->with('moduleAccess', $moduleAccess)
                            ->with('usersCompany', $usersCompany)
                            ->with('companyModule', $companyModul)
                            ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_users_user_window($method, $id = null, $request)
    {
        $activeModule = $this->activeModule();
        $thisUserAcct = $this->activeUser(decrypt($id));
        $usersCompany = $this->usersCompany(decrypt($id));
        $usersModules = $this->usersModule(decrypt($id), $this->usersDefaultCompany(decrypt($id))->company_id);;
        $windowAccess = $this->usersWindow(decrypt($id), $request->company_id, $request->module_id);
        $moduleWindow = $this->moduleWindow($activeModule->module_id);

        return $this->myViewMethodLoader($method)
                            ->with('moduleTo', $activeModule)
                            ->with('allWindow', $moduleWindow)
                            ->with('usersModule', $usersModules)
                            ->with('windowAccess', $windowAccess)
                            ->with('usersCompany', $usersCompany)
                            ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_users_user_method($method, $id = null, $request)
    {
        $thisUserAcct = $this->activeUser(decrypt($id));

        $usersCompany = $this->usersAllCompany(decrypt($id));

        return $this->myViewMethodLoader($method)
                            ->with('usersCompany', $usersCompany)
                            ->with('thisUserAccount', $thisUserAcct);
    }
  
    public function accounts_search_users_module($method, $id = null, $request) 
    {
        $usersModule = $this->usersAllModule(decrypt($request->users_id));

        return $this->myViewMethodLoader($method)->with('usersModule', $usersModule);
    }

    public function accounts_search_users_method($method, $id = null, $request)
    {
        $thisUser = $this->activeUser(decrypt($id));

        $usersWindowMethod = $this->getUserWindowAccess(decrypt($request->users_id));

        $usersMethodAccess = $this->getUserWindowMethodAccess(decrypt($id), $request->company_id, $request->module_id, $request->window_id);

        return $this->myViewMethodLoader($method)
                    ->with('thisUserAccount', $thisUser)
                    ->with('allMethods', $usersWindowMethod)
                    ->with('methodAccess', $usersMethodAccess);
    }

    public function accounts_search_company_users_table($method, $id = null, $request)
    {
        $companyUsers = $this->companyUsers($request->company_id);

        return $this->myViewMethodLoader($method)->with('companyUsers', $companyUsers);
    }

}