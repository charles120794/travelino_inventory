<?php

namespace App\Http\Controllers\Manage\Admin\Inventory;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller 
{
	
	use \App\Http\Traits\Modules\Inventory\InventoryCollectionModifierTrait;
	use \App\Http\Traits\Modules\Inventory\InventoryDashboardTrait; 
	use \App\Http\Traits\Modules\Inventory\InventoryDashboardWidgetsTrait; 
	use \App\Http\Traits\Modules\Inventory\InventoryMethodLoaderTrait; 
	use \App\Http\Traits\Modules\Inventory\InventoryDataTableTrait;
	use \App\Http\Traits\Modules\Inventory\InventoryWindowLoaderTrait; 

	/* Activity Trait */
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryIssuanceReturnTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryIssuanceTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryPhysicalCountTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryStockTransferTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryCashierTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryOrderTrait;
	use \App\Http\Traits\Modules\Inventory\Activity\InventoryBasketTrait;

	/* Table and Maintenance */
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryActiveGroupTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryAddressTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryContactTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryCurrencyTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryCustomerTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryDepartmentTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryItemTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryItemGroupTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventorySupplierTrait; 
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryWarehouseTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryUnitMeasureTrait; 
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryWarehouseGroupTrait;
	use \App\Http\Traits\Modules\Inventory\Maintenance\InventoryVariationTrait; 

	/* Report Trait */
	use \App\Http\Traits\Modules\Inventory\Report\InventoryCashierReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryFirstInReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryFirstOutReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryHistorycalReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryIssuanceAnalysisReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryIssuanceReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryIssuanceReturnReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryItemListingReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryNonMovingItemReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryPhysicalCountReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryStockAgingReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryStockLedegerReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryStockMovementReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryStockonHandReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventoryStockTransferReportTrait;
	use \App\Http\Traits\Modules\Inventory\Report\InventorySupplierListingReportTrait;

}