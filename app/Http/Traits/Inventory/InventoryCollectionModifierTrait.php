<?php

namespace App\Http\Traits\Inventory;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Yajra\Datatables\Datatables;

trait InventoryCollectionModifierTrait
{
	
	public function inventory_retrieve_customer_json()
	{
		return collect($this->inventory_retrieve_customer())->transform(function($item, $key) {

			return [
				'customer_id'   => $item->customer_id,
				'customer_name' => $item->customer_description
			];

		})->toJson();
	}
	
	public function inventory_retrieve_customer_json_id()
	{
		return collect($this->inventory_retrieve_customer())->transform(function($item) {

			return [
				'customer_id'   => $item->customer_id,
				'customer_name' => $item->customer_description
			];

		})->filter(function($item) {
			return $item['customer_id'] == decrypt(request()->customer);
		})->first();
	}

	public function CustomPaginate($items, $perPage = 10, $page = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? $items : Collection::make($items);

		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
	}
}