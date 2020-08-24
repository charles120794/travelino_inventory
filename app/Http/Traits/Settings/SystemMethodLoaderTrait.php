<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemMethodLoaderTrait
{
	
	public function settings_edit_system_company($method, $id = null, $request)
	{
		$allCompany = $this->allCompany();

		$companyInfo = $this->getCompany(decrypt($id));

		$allDefaultModule = $this->allDefaultModule();

	    $allNotDefaultModule = $this->allDefaultModule('no');

	    $moduleAccess = collect($this->companyModule(decrypt($id)))->pluck('module_id')->toArray();
		
		return $this->myViewMethodLoader($method)
					->with('allCompany', $allCompany)
					->with('companyInfo', $companyInfo)
	                ->with('moduleAccess', $moduleAccess)
					->with('allDefaultModule', $allDefaultModule)
	                ->with('allNotDefaultModule', $allNotDefaultModule)
	                /* Route Action */
					->with('createCompany', $this->createSystemCompany)
					->with('updateCompany', $this->updateSystemCompany);
	}

	public function settings_edit_system_module($method, $id = null, $request)
	{

		$allModule = $this->allModule();

		$getModule = $this->getModule(decrypt($id));

		return $this->myViewMethodLoader($method)
		            ->with('allModule', $allModule)
		            ->with('moduleInfo', $getModule)
		            ->with('createModule', $this->createSystemModule)
		            ->with('updateModule', $this->updateSystemModule);
	}

	public function setting_search_company_module_table($method, $id = null, $request)
	{   
	    $companyModule = $this->companyModule($request->company_id);

	    $modulesAccess = $this->getUserModuleAccess(decrypt($id), $request->company_id);

	    return $this->myViewMethodLoader($method)
	                ->with('companyId', $request->company_id)
	                ->with('moduleAccess', $modulesAccess)
	                ->with('companyModule', $companyModule);
	}

	public function settings_search_module_window($method, $id = null, $request)
	{
		$allWindowParent = $this->allWindowWithDropdown($request->module_id);

		$moduleWindow = $this->nestedModuleWindow($request->module_id);

		return $this->myViewMethodLoader($method)
					->with('allWindow', $moduleWindow)
					->with('allWindowParent', $allWindowParent)
					->with('createWindow', $this->createSystemWindow)
					->with('updateWindow', $this->updateSystemWindow);
	}

	public function settings_search_module_window_data($method, $id = null, $request)
	{
		return $this->allWindowWithDropdown($request->module_id);
	}

}