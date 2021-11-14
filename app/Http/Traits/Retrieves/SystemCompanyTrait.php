<?php

namespace App\Http\Traits\Retrieves;

use App\Model\Settings\SystemCompany;

trait SystemCompanyTrait
{

	public function activeCompany()
	{
		return $this->usersDefaultCompany();
	}

	public function allCompany($companies = [])
	{
		$systemCompany = new SystemCompany;

		return (collect($companies)->isNotEmpty()) 

				? 	$systemCompany->whereIn('company_id', $companies)->orderBy('order_level','asc')->get() 

				: 	$systemCompany->orderBy('order_level','asc')->get() ; 
	}

	public function allActiveCompany($companies = [])
	{
		return collect($this->allCompany($companies))->filter(function($company, $key){
			return $company->status == 1;
		});
	}

	public function companyPlan($planID)
	{
		// return app('SystemCompanyPlan')->where('plan_id', $planID)->first();
	}

	public function companyUsers($companyID = null)
	{
		$company = new SystemCompany;

		if ( !is_null($companyID) ) {

			$company = $company->where('company_id', $companyID)->first();

			$accessCompany = (collect($company->usersAccess)->isNotEmpty()) 

					? 	$company->usersAccess->pluck('userInfo') : [] ;

		} else {

			$accessCompany = (collect($this->activeCompany())->isNotEmpty()) 

					? 	$this->activeCompany()->usersAccess->pluck('userInfo') : [] ;
		}

		return $accessCompany;
	}

	public function companyModule($companyID = null)
	{
		$company = new SystemCompany;

		if ( !is_null($companyID) ) {

			$company = $company->where('company_id', $companyID)->first();

			$accessCompany = (collect($company->moduleAccess)->isNotEmpty()) 

					? 	$company->moduleAccess->pluck('moduleInfo') : [] ;

		} else {

			$accessCompany = (collect($this->activeCompany())->isNotEmpty()) 

					? 	$this->activeCompany()->moduleAccess->pluck('moduleInfo') : [] ;
		}

		return $accessCompany;
	}

}