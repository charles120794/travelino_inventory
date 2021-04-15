<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       TRAITS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('InventoryDashboardTrait', function () {
            return \App\Http\Traits\Inventory\InventoryDashboardTrait::class;
        });
        
        $this->app->singleton('InventoryWindowLoaderTrait', function () {
            return \App\Http\Traits\Inventory\InventoryWindowLoaderTrait::class;
        });

        $this->app->singleton('InventoryMethodLoaderTrait', function () {
            return \App\Http\Traits\Inventory\InventoryMethodLoaderTrait::class;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       ACTIVITY        //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('InventoryIssuanceReturnTrait', function () {
            return \App\Http\Traits\Inventory\Activity\InventoryIssuanceReturnTrait::class;
        });

        $this->app->singleton('InventoryIssuanceTrait', function () {
            return \App\Http\Traits\Inventory\Activity\InventoryIssuanceTrait::class;
        });

        $this->app->singleton('InventoryPhysicalCountTrait', function () {
            return \App\Http\Traits\Inventory\Activity\InventoryPhysicalCountTrait::class;
        });

        $this->app->singleton('InventoryStockTransferTrait', function () {
            return \App\Http\Traits\Inventory\Activity\InventoryStockTransferTrait::class;
        });

        $this->app->singleton('InventoryCashierTrait', function () {
            return \App\Http\Traits\Inventory\Activity\InventoryCashierTrait::class;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       MAINTENENACE        //////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('InventoryDepartmentTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryDepartmentTrait::class;
        });

        $this->app->singleton('InventoryAddressTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryAddressTrait::class;
        });

        $this->app->singleton('InventoryContactTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryContactTrait::class;
        });

        $this->app->singleton('InventoryItemTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryItemTrait::class;
        });

        $this->app->singleton('InventoryItemGroupTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryItemGroupTrait::class;
        });

        $this->app->singleton('InventoryCustomerTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryCustomerTrait::class;
        });

        $this->app->singleton('InventorySupplierTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventorySupplierTrait::class;
        });

        $this->app->singleton('InventoryWarehouseTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryWarehouseTrait::class;
        });

        $this->app->singleton('InventoryUnitMeasureTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryUnitMeasureTrait::class;
        });

        $this->app->singleton('InventoryWarehouseGroupTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryWarehouseGroupTrait::class;
        });

        $this->app->singleton('InventoryVariationTrait', function () {
            return \App\Http\Traits\Inventory\Maintenance\InventoryVariationTrait::class;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       REPORT        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('InventoryCashierReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryCashierReportTrait::class;
        });

        $this->app->singleton('InventoryFirstInReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryFirstInReportTrait::class;
        });

        $this->app->singleton('InventoryFirstOutReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryFirstOutReportTrait::class;
        });

        $this->app->singleton('InventoryHistorycalReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryHistorycalReportTrait::class;
        });

        $this->app->singleton('InventoryIssuanceAnalysisReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryIssuanceAnalysisReportTrait::class;
        });

        $this->app->singleton('InventoryIssuanceReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryIssuanceReportTrait::class;
        });

        $this->app->singleton('InventoryIssuanceReturnReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryIssuanceReturnReportTrait::class;
        });

        $this->app->singleton('InventoryItemListingReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryItemListingReportTrait::class;
        });

        $this->app->singleton('InventoryNonMovingItemReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryNonMovingItemReportTrait::class;
        });

        $this->app->singleton('InventoryPhysicalCountReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryPhysicalCountReportTrait::class;
        });

        $this->app->singleton('InventoryStockAgingReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryStockAgingReportTrait::class;
        });

        $this->app->singleton('InventoryStockLedegerReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryStockLedegerReportTrait::class;
        });

        $this->app->singleton('InventoryStockMovementReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryStockMovementReportTrait::class;
        });

        $this->app->singleton('InventoryStockonHandReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryStockonHandReportTrait::class;
        });

        $this->app->singleton('InventoryStockTransferReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventoryStockTransferReportTrait::class;
        });

        $this->app->singleton('InventorySupplierListingReportTrait', function () {
            return \App\Http\Traits\Inventory\Report\InventorySupplierListingReportTrait::class;
        });

    }

}