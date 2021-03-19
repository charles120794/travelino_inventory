<?php

namespace App\Http\Controllers\Manage\Admin\Inventory;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller 
{
	use \App\Http\Traits\Inventory\InventoryWindowLoaderTrait; 
	use \App\Http\Traits\Inventory\InventoryMethodLoaderTrait; 

	/* Activity Trait */
	use \App\Http\Traits\Inventory\Activity\InventoryIssuanceReturnTrait;
	use \App\Http\Traits\Inventory\Activity\InventoryIssuanceTrait;
	use \App\Http\Traits\Inventory\Activity\InventoryPhysicalCountTrait;
	use \App\Http\Traits\Inventory\Activity\InventoryStockTransferTrait;

	/* Table and Maintenance */
	use \App\Http\Traits\Inventory\Maintenance\InventoryActiveGroupTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryAddressTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryContactTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryCurrencyTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryCustomerTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryDepartmentTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryItemTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryItemGroupTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventorySupplierTrait; 
	use \App\Http\Traits\Inventory\Maintenance\InventoryWarehouseTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryUnitMeasureTrait; 
	use \App\Http\Traits\Inventory\Maintenance\InventoryWarehouseGroupTrait;
	use \App\Http\Traits\Inventory\Maintenance\InventoryVariationTrait; 

	/* Report Trait */
	use \App\Http\Traits\Inventory\Report\InventoryFirstInReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryFirstOutReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryHistorycalReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryIssuanceAnalysisReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryIssuanceReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryIssuanceReturnReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryItemListingReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryNonMovingItemReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryPhysicalCountReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryStockAgingReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryStockLedegerReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryStockMovementReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryStockonHandReportTrait;
	use \App\Http\Traits\Inventory\Report\InventoryStockTransferReportTrait;
	use \App\Http\Traits\Inventory\Report\InventorySupplierListingReportTrait;
}