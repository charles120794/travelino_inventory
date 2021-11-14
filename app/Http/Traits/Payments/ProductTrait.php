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

trait ProductTrait
{
	protected function getCustomerBillingInfo()
	{
		return TableConsumer::where('users_id', $this->thisUser()->users_id)->first();
	}

	protected function getModuleData($request)
	{
		return app('SystemModule')
				->where('module_id', decrypt($request->input('module_id')))
				->first();
	}
}