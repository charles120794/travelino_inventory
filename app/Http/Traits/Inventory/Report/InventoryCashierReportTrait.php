<?php

namespace App\Http\Traits\Inventory\Report;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\Activity\InventoryActivityCashier;

trait InventoryCashierReportTrait
{
	public function inventory_cashier_print_receipt($method, $id, $request)
	{
		$cashier = InventoryActivityCashier::with('cashierDetails')->where('cashier_id', decrypt($id))->first();

		abort_if(collect($cashier)->isEmpty(), 403, 'Cashier Receipt Not Found!');

		$company = $this->getUserDefaultCompany();

		return $this->myViewMethodLoader($method)
					->with('cashier', $cashier)
					->with('company', $company);
	}
}