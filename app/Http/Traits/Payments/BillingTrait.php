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

trait BillingTrait
{
	
	protected function getUserBilling($invoiceID, $user)
	{
		$invoice = SystemInvoice::query();

		$invoice->where('users_id', $user->users_id)->where('company_id', $user->company_id);

		return $invoice->where('invoice_id', $invoiceID)->first();
	}

	protected function getUsersBilling($user, $status = null)
	{
		$invoice = SystemInvoice::query();

		$invoice->where('users_id', $user->users_id)->where('company_id', $user->company_id);

		$invoice->when(!is_null($status), function($query) use ($status) {
			return $query->where('invoice_status', $status);
		});

		return $invoice->orderBy('created_date','desc')->get();
	}

	protected function getUsersBillingGroup($user)
	{
		$invoiceGroup = SystemInvoiceGroup::query();

		$invoiceGroup->where('users_id', $user->users_id)->where('company_id', $user->company_id);

		return $invoiceGroup->orderBy('created_date','desc')->get();
	}

	protected function getUsersBillingHistory($user)
	{

	}

}