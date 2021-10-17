<?php

namespace App\Http\Traits\Inventory;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait InventoryCollectionModifierTrait
{

	public function html_collect_customers()
	{
		$customers = [
			'search'    => request()->get('search'),
			'customers' => $this->inventory_cashier_customer(),
		];

		return view('manage.inventory.activity.pagination.modalcustomerpage', $customers);
	}

	public function html_collect_customers_json()
	{
		$customers = [
			'search'    => request()->get('search'),
			'customers' => $this->inventory_cashier_customer(),
		];
		
		return response()->json($customers);
	}

	public function CustomPaginate($items, $perPage = 10, $page = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? $items : Collection::make($items);

		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
	}
}