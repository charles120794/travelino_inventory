<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
 
trait SystemWindowLoaderTrait
{

	public function settings_dashboard($window)
	{
	    return $this->myViewLoader($window);
	}

	public function settings_company($window)
	{
	    $allCompany = $this->allCompany();

	    $allDefaultModule = $this->allDefaultModule();

	    $allNotDefaultModule = $this->allDefaultModule('no');

	    return $this->myViewLoader($window)
	                ->with('allCompany', $allCompany)
	                ->with('allDefaultModule', $allDefaultModule)
	                ->with('allNotDefaultModule', $allNotDefaultModule)
	                ->with('createCompany', $this->createSystemCompany);
	}

	public function settings_window($window)
	{
	    $usersModule = $this->usersAllModule($this->thisUser()->users_id, $this->thisUser()->company_id);

	    $usersCompany = $this->usersAllCompany($this->thisUser()->users_id);

	    return $this->myViewLoader($window)
	                ->with('usersModule', $usersModule)
	                ->with('usersCompany', $usersCompany)
	                ->with('createWindow', $this->createSystemWindow);
	}

	public function settings_module($window)
	{
	    $allModule = $this->allModule();

	    $usersCompanyAccess = $this->usersCompany($this->thisUser()->users_id);
	    
	    return $this->myViewLoader($window)
	                ->with('allModule', $allModule)
	                ->with('usersCompanyAccess', $usersCompanyAccess)
	                ->with('formSearchModule', $this->formSearchModule)
	                ->with('createModule', $this->createSystemModule);
	}

	public function settings_method($window)
	{
		return $this->myViewLoader($window)
		            ->with('createMethod', $this->createSystemMethod);
	}

}