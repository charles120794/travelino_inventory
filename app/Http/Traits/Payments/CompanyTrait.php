<?php

namespace App\Http\Traits\Payments;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

use App\Model\Settings\SystemInvoice;
use App\Model\Settings\SystemUsersPlan;
use App\Model\Settings\SystemInvoiceGroup;
use App\Model\Settings\SystemInvoiceDetails;
use App\Model\Settings\SystemInvoiceHistory;
use App\Model\Tables\TableConsumer;

trait CompanyTrait
{

	public function companyAddForm($planID, Request $request)
	{
		$thisUser = $this->thisUser();

		$companyPlan = $this->companyPlan(decrypt($planID));

		if(count($companyPlan) > 0) {

			return view('manage.landing.companyadddetails',[
				'thisUser' => $thisUser,
				'companyPlan' => $companyPlan,
			]);

		} else {
			abort('500');
		}
		
	}

	public function companyEditForm($company, Request $request)
	{
		$thisUser = $this->thisUser();

		$companyInfo = $this->getCompany(decrypt($company));

		if(count($companyInfo) == 0) {
			abort('500');
		}

		return view('manage.landing.companyeditdetails',[
			'thisUser' => $thisUser,
			'companyInfo' => $companyInfo,
		]);
	}

	public function companyCreate($user, Request $request)
	{

		$this->validate($request,[
			'company_plan'             => 'required',
			'company_code'             => 'required',
			'company_name'             => 'required',
			'company_email'            => 'required',
			'company_address'          => 'required',
			'contact_person'           => 'required',
			'company_foundation'       => 'required',
			'contact_person_phone'     => 'required',
			'contact_person_email'     => 'required',
			'contact_person_address'   => 'required',
			'company_registered_owner' => 'required',
		]);

		$companyPlan = $this->companyPlan(decrypt($request->input('company_plan')));

		$getCompanyId                             = app('SystemCompany');
		$getCompanyId->company_plan               = decrypt($request->company_plan);
		$getCompanyId->company_code               = $request->input('company_code');
		$getCompanyId->company_name               = $request->input('company_name');
		$getCompanyId->company_tagline            = $request->input('company_tagline');
		$getCompanyId->company_email              = $request->input('company_email');
		$getCompanyId->company_website            = $request->input('company_website');
		$getCompanyId->company_address            = $request->input('company_address');
		$getCompanyId->company_foundation         = $request->input('company_foundation');
		$getCompanyId->company_description        = $request->input('company_description');
		$getCompanyId->company_registered_owner   = $request->input('company_registered_owner');

		$getCompanyId->contact_person             = $request->input('contact_person');
		$getCompanyId->contact_person_phone       = $request->input('contact_person_phone');
		$getCompanyId->contact_person_email       = $request->input('contact_person_email');
		$getCompanyId->contact_person_address     = $request->input('contact_person_address');
		$getCompanyId->contact_person_social_link = $request->input('contact_person_social_link');

		$getCompanyId->created_by                 = $this->getUser($user)->users_id;
		$getCompanyId->created_date               = (new CommonService)->dateTimeToday('Y-m-d h:i:s');
		/* COMPANY STATUS */
		$getCompanyId->company_status             = (count($companyPlan) > 0 && $companyPlan->plan_total_amount > 0) ? 'inactive' : 'active' ;
		$getCompanyId->status                     = (count($companyPlan) > 0 && $companyPlan->plan_total_amount > 0) ? false : true ;

		if($getCompanyId->save()) {

			$usersCompanyAccess = app('UsersCompanyAccess');

			$usersCompanyAccess->status       =  false;
			$usersCompanyAccess->plan_status  = 'inactive';
			$usersCompanyAccess->company_id   = $getCompanyId->company_id;
			$usersCompanyAccess->users_id     = $this->getUser($user)->users_id;
			$usersCompanyAccess->created_by   = $this->getUser($user)->users_id;
			$usersCompanyAccess->created_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

			$usersCompanyAccess->save();

			/*
			 * If your created new account for the user
			 * add also the default module access
			*/
			$usersDefaultModule = $this->usersAllDefaultModule('yes');

			foreach( $usersDefaultModule as $value ) {

				$usersModuleAccess = app('UsersModuleAccess');

				$usersModuleAccess->status       =  true;
				$usersModuleAccess->plan_status  = 'active';
				$usersModuleAccess->company_id   = $getCompanyId->company_id;
				$usersModuleAccess->module_id    = $value->module_id;
				$usersModuleAccess->users_id     = $this->getUser($user)->users_id;
				$usersModuleAccess->created_by   = $this->getUser($user)->users_id;
				$usersModuleAccess->created_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

				$usersModuleAccess->save();

			}

			if(count($companyPlan) > 0 && $companyPlan->plan_total_amount > 0) {

				$companyPlan->company_id = $getCompanyId->company_id;

				return $this->createCompanyInvoice($companyPlan);

			}

			Session::flash('success','You have successfully created your company.');
			return back();

		} else {

			$getCompanyId->delete();

			Session::flash('failed','Looks like something went wrong during the insertion process, Please try again.');
			return back();

		}

	}

	protected function createCompanyInvoice($companyPlan)
	{

		$invoiceGroup   = new SystemInvoiceGroup;
		$invoiceModel   = new SystemInvoice;
		$invoiceDetails = new SystemInvoiceDetails;
		$invoiceHistory = new SystemInvoiceHistory;

		$createUniqID = strtoupper(uniqid());
		/* Get Customer Billing Info */
		$billingInfo = $this->getCustomerBillingInfo();

		if(count($billingInfo) == 0) {
			return redirect()->url('/create/billing/' . encrypt($this->thisUser()->users_id));
		}

		$invoiceGroup->group_code        = $createUniqID;
		$invoiceGroup->group_method      = $companyPlan->plan_method;
		$invoiceGroup->group_description = $companyPlan->plan_description;
		$invoiceGroup->users_id          = $this->thisUser()->users_id;
		$invoiceGroup->company_id        = $this->thisUser()->company_id;
		$invoiceGroup->created_by        = $this->thisUser()->users_id;
		$invoiceGroup->created_date      = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

		if($invoiceGroup->save()) {
			// Information
			$invoiceModel->invoice_source                = 'company';
			$invoiceModel->group_id                      = $invoiceGroup->group_id;
			$invoiceModel->invoice_number                = $createUniqID;
			$invoiceModel->invoice_item                  = $companyPlan->company_id;
			$invoiceModel->invoice_method                = $companyPlan->plan_method;
			$invoiceModel->invoice_supplier              = $companyPlan->plan_supplier;
			$invoiceModel->invoice_customer              = $billingInfo->consumer_id;
			// Amounts
			$invoiceModel->invoice_total_vat_amount        = $companyPlan->plan_vat_amount;
			$invoiceModel->invoice_total_gross_amount      = $companyPlan->plan_gross_amount;
			$invoiceModel->invoice_total_exempt_amount     = $companyPlan->plan_exempt_amount;
			$invoiceModel->invoice_total_zero_rated_amount = $companyPlan->plan_zro_rated_amount;
			$invoiceModel->invoice_total_discount_amount   = $companyPlan->plan_discount_amount;
			$invoiceModel->invoice_total_total_amount      = $companyPlan->plan_total_amount;
			// Credits
			$invoiceModel->users_id                       = $this->thisUser()->users_id;
			$invoiceModel->company_id                     = $this->thisUser()->company_id;
			$invoiceModel->created_by                     = $this->thisUser()->users_id;
			$invoiceModel->invoice_date                   = (new CommonService)->dateTimeToday('Y-m-d');
			$invoiceModel->created_date                   = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

			if($invoiceModel->save()) {

				$invoiceDetails->detail_code              = $createUniqID;
				$invoiceDetails->invoice_id               = $invoiceModel->invoice_id;
				$invoiceDetails->detail_description       = $companyPlan->plan_description;
				$invoiceDetails->detail_vat_amount        = $companyPlan->plan_vat_amount;
				$invoiceDetails->detail_gross_amount      = $companyPlan->plan_gross_amount;
				$invoiceDetails->detail_exempt_amount     = $companyPlan->plan_exempt_amount;
				$invoiceDetails->detail_zero_rated_amount = $companyPlan->plan_zero_rated_amount;
				$invoiceDetails->detail_discount_amount   = $companyPlan->plan_discount_amount;
				$invoiceDetails->detail_total_amount      = $companyPlan->plan_total_amount;

				if($invoiceDetails->save()) {

					$invoiceHistory->history_code        = $createUniqID;
					$invoiceHistory->invoice_id          = $invoiceModel->invoice_id;
					$invoiceHistory->created_by          = $this->thisUser()->users_id;
					$invoiceHistory->created_date        = (new CommonService)->dateTimeToday('Y-m-d h:i:s');
					$invoiceHistory->history_description = 'Created Invoice ' . $createUniqID . ' at ' . (new CommonService)->dateTimeToday('Y-m-d h:i:s');

					if($invoiceHistory->save()) {

						$usersID = encrypt($this->thisUser()->users_id);

						$invoiceID = encrypt($invoiceModel->invoice_id);

						return redirect('/invoice/' . $invoiceID . '/' . $usersID);

					} else {
						/* Rollback when child failed to insert */
						$invoiceGroup->delete();
						$invoiceModel->delete();
						$invoiceDetails->delete();

						Session::flash('failed','Looks like something went wrong during the insertion process, Please try again.');
						return back();
					}

				} else {
					/* Rollback when child failed to insert */
					$invoiceGroup->delete();
					$invoiceModel->delete();

					Session::flash('failed','Looks like something went wrong during the insertion process, Please try again.');
					return back();
					
				}

			} else {
				/* Rollback when child failed to insert */
				$invoiceGroup->delete();

				Session::flash('failed','Looks like something went wrong during the insertion process, Please try again.');
				return back();
			}

		} else {

			Session::flash('failed','Looks like something went wrong during the insertion process, Please try again.');
			return back();
		}

	}

	public function companyUpdate(Request $request)
	{
		$this->validate($request,[
			'company_code'             => 'required',
			'company_name'             => 'required',
			'company_email'            => 'required',
			'company_address'          => 'required',
			'contact_person'           => 'required',
			'company_foundation'       => 'required',
			'contact_person_phone'     => 'required',
			'contact_person_email'     => 'required',
			'contact_person_address'   => 'required',
			'company_registered_owner' => 'required',
		]);
	}

	public function updateActiveCompany($company, $user, Request $request)
	{
		$updatedCompany = app('Users')->where('users_id', decrypt($user))->update(['company_id' => decrypt($company)]);

		if($updatedCompany) {
			Session::flash('success','Company successfully changed.');
			return back();
		} else {
			Session::flash('failed','Cannot change your existing Company.');
			return back();
		}
	}
	
}