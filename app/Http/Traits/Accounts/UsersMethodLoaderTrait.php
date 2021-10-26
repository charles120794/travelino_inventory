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
        $usersCompany = $this->usersAllCompany(decrypt($id));

        return $this->myViewMethodLoader($method)->with('usersCompany', $usersCompany);
    }

    public function accounts_search_users_module_table($method, $id = null, $request)
    {
        return $this->myViewMethodLoader($method,[
            'companyId'       => $request->company_id,
            'thisUserAccount' => $this->getUser($id),
            'companyModule'   => $this->companyModule($request->company_id),
            'moduleAccess'    => $this->getUserModuleAccess(decrypt($id), $request->company_id),
        ]);
    }

    public function accounts_search_users_window_table($method, $id = null, $request)
    {
        $thisUserAcct = $this->getUser($id);

        $moduleWindow = $this->moduleWindow($request->module_id);

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
        $thisUserAccou = $this->getUser($id);

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
        return $this->myViewMethodLoader($method)
                            ->with('thisUserAccount', $this->getUser($id));
    }

    public function accounts_users_user_company($method, $id = null, $request)
    {
        $thisUserAccou = $this->getUser($id);

        $systemCompany = $this->activeCompany();

        $userCompanies = $this->getUserCompanyAccess(decrypt($id));

        return $this->myViewMethodLoader($method)
                            ->with('usersCompany', $userCompanies)
                            ->with('systemCompany', $systemCompany)
                            ->with('thisUserAccount', $thisUserAccou);
    }

    public function accounts_users_user_module($method, $id = null, $request)
    {
        $thisUserAcct = $this->getUser($id);

        $usersCompany = $this->usersAllCompany(decrypt($id));

        $companyModul = $this->companyModule($thisUserAcct->company_id);

        $moduleAccess = $this->getUserModuleAccess(decrypt($id), $thisUserAcct->company_id);

        return $this->myViewMethodLoader($method)
                            ->with('companyId', $thisUserAcct->company_id)
                            ->with('moduleAccess', $moduleAccess)
                            ->with('usersCompany', $usersCompany)
                            ->with('companyModule', $companyModul)
                            ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_users_user_window($method, $id = null, $request)
    {
        $thisUserAcct = $this->getUser($id);

        $activeModule = $this->getModulePrefix();

        $usersModules = $this->usersAllModule(decrypt($id));

        $usersCompany = $this->usersAllCompany(decrypt($id));

        $windowAccess = $this->getUserWindowAccess(decrypt($id), $request->company_id, $request->module_id);

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
        $thisUserAcct = $this->getUser($id);

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
        $thisUser = $this->getUser($id);

        $usersWindowMethod = $this->getUserWindowAccess(decrypt($request->users_id));

        $usersMethodAccess = $this->getUserWindowMethodAccess(decrypt($id), $request->company_id, $request->module_id, $request->window_id);

        return $this->myViewMethodLoader($method)
                    ->with('thisUserAccount', $thisUser)
                    ->with('allMethods', $usersWindowMethod)
                    ->with('methodAccess', $usersMethodAccess);
    }

    public function accounts_search_company_users_table($method, $id = null, $request)
    {
        $allSelected = (is_null($request->company_id)) ? true : false ;

        $companyUser = (!is_null($request->company_id)) ? $this->companyUsers($request->company_id) : $this->allUsers() ;

        return $this->myViewMethodLoader($method)
                    ->with('allUsers', $companyUser)
                    ->with('allSelected', $allSelected);
    }

}