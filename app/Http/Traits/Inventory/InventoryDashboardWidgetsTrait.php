<?php

namespace App\Http\Traits\Inventory;

use DB;
use Session;
use Illuminate\Http\Request;

use App\Model\Inventory\activity\InventoryActivityCashier;
use App\Model\Inventory\activity\InventoryActivityCashierDetails;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;

trait InventoryDashboardWidgetsTrait
{

	public function inventory_cashier_total_purchase()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_purchase_price');
	}

	public function inventory_cashier_total_selling()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_selling_price');
	}

	public function inventory_cashier_total_vat_amount()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_vat_amount');
	}

	public function inventory_cashier_total_vatable()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_vatable_amt');
	}

	public function inventory_cashier_total_gross()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_gross_amt');
	}

	public function inventory_cashier_total_quantity_sold()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_quantity');
	}

	public function inventory_cashier_total_qty_sold_cost()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_purchase_price');
	}

	public function inventory_cashier_total_qty_sold_price()
	{
		return collect($this->inventory_cashier_details())->sum('cashier_selling_price');
	}

}