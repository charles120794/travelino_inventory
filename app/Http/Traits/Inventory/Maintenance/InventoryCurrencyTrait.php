<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableCurrency;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryCurrencyTrait
{

	public function currency_data()
	{
		$currency = new InventoryTableCurrency;

		$currency = $currency->when(!is_null(request()->get('search')), function($query) {
			return $query->where('currency_code','like','%'.request()->get('search').'%')
						 ->orWhere('currency_description','like','%'.request()->get('search').'%');
		});

		return $currency->orderBy('order_level','asc')->get();
	}

	public function inventory_create_currency($method, $id, $request)
	{
		if($request->has('option')) {
			foreach ($request->get('option') as $key => $value) {
				InventoryTableCurrency::insert([
					'currency_code'        => $value['code'],
					'currency_description' => $value['description'],
					'created_by'           => $this->thisUser()->users_id,
					'created_date'         => (new CommenService)->dateTimeToday('Y-m-d h:i:s'),
					'order_level'          => (new CommenService)->orderLevel(new InventoryTableCurrency),
				]);
			}
			$request->session()->flash('success','Contact(s) successfully created');
			return back();
		}
	}

}