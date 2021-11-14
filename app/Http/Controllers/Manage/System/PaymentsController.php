<?php

namespace App\Http\Controllers\Manage\System;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Tables\TableConsumer;

use App\Model\Settings\SystemInvoice;
use App\Model\Settings\SystemInvoiceGroup;

use App\Http\Traits\Accounts\UsersAccountTrait;

use App\Http\Traits\Payments\AccountTrait;
use App\Http\Traits\Payments\BillingTrait;
use App\Http\Traits\Payments\CompanyTrait;
use App\Http\Traits\Payments\ModuleTrait;
use App\Http\Traits\Payments\ProductTrait;

use App\Http\Controllers\Common\CommonServiceController as CommonService;

class PaymentsController extends Controller 
{

	use UsersAccountTrait;
	use ModuleTrait, BillingTrait, ProductTrait, CompanyTrait, AccountTrait;

	public function index(Request $request)
	{
		$thisUser           = $this->thisUser();

		$usersCompany       = $this->usersAllCompany($thisUser->users_id);

		$usersModuleSale    = $this->usersAllModule($thisUser->users_id, $thisUser->company_id, 'no');

		$usersModuleDefault = $this->usersAllModule($thisUser->users_id, $thisUser->company_id, 'yes');

		return view('manage.landing.index',[
			'thisUser'           => $thisUser,
			'usersCompany'       => $usersCompany,
			'usersModuleSale'    => $usersModuleSale,
			'usersModuleDefault' => $usersModuleDefault,
		]);
	}

	public function companyIndex(Request $request)
	{
		$thisUser = $this->thisUser();

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		return view('manage.landing.companyindex',[
			'thisUser'     => $thisUser,
			'usersCompany' => $usersCompany,
		]);
	}

	public function accountIndex(Request $request)
	{
		$thisUser = $this->thisUser();

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		return view('manage.landing.accountindex',[
			'thisUser'     => $thisUser,
			'usersCompany' => $usersCompany,
		]);
	}

	public function billingIndex(Request $request)
	{
		$thisUser           = $this->thisUser();

		$usersInvoice       = $this->getUsersBilling($thisUser);

		$usersCompany       = $this->usersAllCompany($thisUser->users_id);

		$usersBillingGroup  = $this->getUsersBillingGroup($thisUser);

		$usersUnpaidBilling = $this->getUsersBilling($thisUser, 'unpaid');

		$usersPaidBilling   = $this->getUsersBilling($thisUser, 'paid');

		return view('manage.landing.billingindex',[
			'thisUser'           => $thisUser,
			'usersCompany'       => $usersCompany,
			'usersInvoice'       => $usersInvoice,
			'usersBillingGroup'  => $usersBillingGroup,
			'usersPaidBilling'   => $usersPaidBilling,
			'usersUnpaidBilling' => $usersUnpaidBilling,
		]);
	}

	public function createBillingIndex($userID)
	{
		$thisUser = $this->getUser($userID);

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		return view('manage.landing.createbilling',[
			'thisUser'     => $thisUser,
			'usersCompany' => $usersCompany,
		]);
	}

	public function profileIndex(Request $request)
	{
		$thisUser = $this->thisUser();

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		$usersAddress = $this->thisUser()->addressInfo;

		return view('manage.landing.profileindex',[
			'thisUser'     => $thisUser,
			'usersCompany' => $usersCompany,
			'usersAddress' => $usersAddress,
		]);
	}

	public function settingIndex(Request $request)
	{
		$thisUser = $this->thisUser();

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		return view('manage.landing.settingindex',[
			'thisUser'     => $thisUser,
			'usersCompany' => $usersCompany,
		]);
	}

	public function moduleIndex(Request $request)
	{
		$thisUser           = $this->thisUser();

		$usersCompany       = $this->usersAllCompany($thisUser->users_id);

		$usersModuleSale    = $this->usersAllDefaultModule('no');

		$usersModuleDefault = $this->usersAllModule($thisUser->users_id, $thisUser->company_id, 'yes');

		return view('manage.landing.moduleindex',[
			'thisUser'           => $thisUser,
			'usersCompany'       => $usersCompany,
			'usersModuleSale'    => $usersModuleSale,
			'usersModuleDefault' => $usersModuleDefault,
		]);
	}

	public function moduleIndexDetails($moduleID, Request $request)
	{
		$thisUser          = $this->thisUser();

		$moduleDetail      = $this->getModule(decrypt($moduleID));

		$usersCompany      = $this->usersAllCompany($thisUser->users_id);

		$usersModuleAccess = $this->getUserModuleAccess($thisUser->users_id, $thisUser->company_id);

		return view('manage.landing.moduledetails',[
			'thisUser'          => $thisUser,
			'moduleDetail'      => $moduleDetail,
			'usersCompany'      => $usersCompany,
			'usersModuleAccess' => $usersModuleAccess,
		]);
	}

	public function invoiceIndex($invoice)
	{
		$thisUser     = $this->thisUser();

		$userBilling  = $this->getUserBilling(decrypt($invoice), $thisUser);

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		return (!is_null($userBilling)) ? 

			view('manage.landing.invoiceindex',[
				'thisUser'     => $thisUser,
				'userBilling'  => $userBilling,
				'usersCompany' => $usersCompany,
			]) : abort('500') ;

	}

}