<?php

namespace App\Http\Traits\Inventory\Report;

use Session;
use Illuminate\Http\Request;

trait InventoryCashierReportTrait
{
	public function inventory_print_preview_cashier($method, $id, $request)
	{
		return view('manage.inventory.report.InventoryCashierReport');
	}
}