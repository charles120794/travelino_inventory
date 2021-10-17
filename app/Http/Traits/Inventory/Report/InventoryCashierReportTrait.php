<?php

namespace App\Http\Traits\Inventory\Report;

use Session;
use Illuminate\Http\Request;

trait InventoryCashierReportTrait
{
	public function inventory_cashier_print_receipt($method, $id, $request)
	{
		return $this->myViewMethodLoader($method);
	}
}