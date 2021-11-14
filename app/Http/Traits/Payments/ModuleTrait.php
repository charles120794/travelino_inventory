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

trait ModuleTrait
{
	
	public function createModuleInvoice(Request $request)
	{

		$invoiceModel   = new SystemInvoice;
		$invoiceGroup   = new SystemInvoiceGroup;
		$invoiceDetails = new SystemInvoiceDetails;
		$invoiceHistory = new SystemInvoiceHistory;

		$createUniqID = strtoupper(uniqid());

		$moduleData   = $this->getModuleData($request);

		$billingInfo  = $this->getCustomerBillingInfo($request);

		if(count($billingInfo) == 0) {
			return redirect()->url('/create/billing/' . encrypt($this->thisUser()->users_id));
		}

		if(count($moduleData) > 0) {

			/* Check Invoice if Exists */
			$systemInvoice = (new SystemInvoice)
								->where('invoice_source', 'module')
								->where('users_id', $this->thisUser()->users_id)
								->where('company_id', $this->thisUser()->company_id)
								->where('invoice_item', decrypt($request->input('module_id')))
								->first();

			if(count($systemInvoice) > 0) {

				$usersID = encrypt($this->thisUser()->users_id);

				$invoiceID = encrypt($systemInvoice->invoice_id);

				return redirect('/invoice/' . $invoiceID . '/' . $usersID);

			}

			$invoiceGroup->group_code        = $createUniqID;
			$invoiceGroup->group_method      = $moduleData->module_method;
			$invoiceGroup->group_description = $moduleData->module_description;
			$invoiceGroup->users_id          = $this->thisUser()->users_id;
			$invoiceGroup->company_id        = $this->thisUser()->company_id;
			$invoiceGroup->created_by        = $this->thisUser()->users_id;
			$invoiceGroup->created_date      = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

			if( $invoiceGroup->save() ) {
				// Information
				$invoiceModel->invoice_source                 = 'module';
				$invoiceModel->group_id                       = $invoiceGroup->group_id;
				$invoiceModel->invoice_number                 = $createUniqID;
				$invoiceModel->invoice_item                   = $moduleData->module_id;
				$invoiceModel->invoice_method                 = $moduleData->module_method;
				$invoiceModel->invoice_supplier               = $moduleData->module_supplier;
				$invoiceModel->invoice_customer               = $billingInfo->consumer_id;
				// Amounts
				$invoiceModel->invoice_total_vat_amount        = $moduleData->module_vat_amount;
				$invoiceModel->invoice_total_gross_amount      = $moduleData->module_gross_amount;
				$invoiceModel->invoice_total_exempt_amount     = $moduleData->module_exempt_amount;
		       	$invoiceModel->invoice_total_zero_rated_amount = $moduleData->module_zero_rate_amount;
				$invoiceModel->invoice_total_discount_amount   = $moduleData->module_discount_amount;
				$invoiceModel->invoice_total_total_amount      = $moduleData->module_total_amount;
				// Credits
				$invoiceModel->users_id                       = $this->thisUser()->users_id;
				$invoiceModel->company_id                     = $this->thisUser()->company_id;
				$invoiceModel->created_by                     = $this->thisUser()->users_id;
				$invoiceModel->invoice_date                   = (new CommonService)->dateTimeToday('Y-m-d');
				$invoiceModel->created_date                   = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

				if( $invoiceModel->save() ) {

					$invoiceDetails->detail_code              = $createUniqID;
					$invoiceDetails->invoice_id               = $invoiceModel->invoice_id;
					$invoiceDetails->detail_description       = $moduleData->module_description;
					$invoiceDetails->detail_vat_amount        = $moduleData->module_vat_amount;
					$invoiceDetails->detail_gross_amount      = $moduleData->module_gross_amount;
					$invoiceDetails->detail_exempt_amount     = $moduleData->module_exempt_amount;
					$invoiceDetails->detail_zero_rated_amount = $moduleData->module_zero_rated_amount;
					$invoiceDetails->detail_discount_amount   = $moduleData->module_discount_amount;
					$invoiceDetails->detail_total_amount      = $moduleData->module_total_amount;

					if( $invoiceDetails->save() ) {

						// Insert Module Access as status of inactive
						$usersModuleAccess               = app('UsersModuleAccess');
						
						$usersModuleAccess->status       =  false;
						$usersModuleAccess->plan_status  = 'inactive';
						$usersModuleAccess->module_id    = $moduleData->module_id;
						$usersModuleAccess->users_id     = $this->thisUser()->users_id;
						$usersModuleAccess->company_id   = $this->thisUser()->company_id;
						$usersModuleAccess->created_by   = $this->thisUser()->users_id;
						$usersModuleAccess->created_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');
						$usersModuleAccess->save();

						// Insert Module History Log for creating Invoce
						$invoiceHistory->history_code        = $createUniqID;
						$invoiceHistory->invoice_id          = $invoiceModel->invoice_id;
						$invoiceHistory->created_by          = $this->thisUser()->users_id;
						$invoiceHistory->created_date        = (new CommonService)->dateTimeToday('Y-m-d h:i:s');
						$invoiceHistory->history_description = 'Created Invoice ' . $createUniqID . ' at ' . (new CommonService)->dateTimeToday('Y-m-d h:i:s');

						if( $invoiceHistory->save() ) {

							$invoiceID = encrypt($invoiceModel->invoice_id);

							return redirect('/invoice/' . $invoiceID);

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

		} else {
			Session::flash('failed','Your have enterred invalid Item. Please try again.');
			return back();
		}

	}

}