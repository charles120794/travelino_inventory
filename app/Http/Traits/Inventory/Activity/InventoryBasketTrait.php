<?php

namespace App\Http\Traits\Inventory\Activity;

use DB;
use Session;
use App\Model\Inventory\Activity\InventoryActivityBasket;

use App\Model\Inventory\maintenance\InventoryTableItem;
use App\Model\Inventory\maintenance\InventoryTableCustomer;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryBasketTrait
{
	public function customer_basket_data($customer)
	{
		return (new InventoryActivityBasket)->where('basket_customer_id', $customer)->get();
	}

	public function customer_basket_data_delete($customer)
	{
		return (new InventoryActivityBasket)->where('basket_customer_id', $customer)->delete(); // Delete All Item From Basket
	}
}