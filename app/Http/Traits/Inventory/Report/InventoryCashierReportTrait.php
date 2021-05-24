<?php

namespace App\Http\Traits\Inventory\Report;

use Session;
use Illuminate\Http\Request;

trait InventoryCashierReportTrait
{
	public function inventory_print_cashier_receipt($method, $id, $request)
	{
		return $this->myViewMethodLoader($method);
	}
}