<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableSupplier;

trait InventorySupplierTrait
{
	public function supplier_data()
	{
		return InventoryTableSupplier::get();
	}
}