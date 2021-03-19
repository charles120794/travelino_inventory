<?php

namespace App\Http\Traits\Inventory;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableItemGroup;
use Illuminate\Support\Arr;

trait InventoryWindowLoaderTrait
{
	public function inventory_dashboard($window)
	{
		return $this->myViewLoader($window);
	}

	public function inventory_cashier($window)
	{
		$customer = $this->customer_data();

		$product  = $this->product_data();

		return $this->myViewLoader($window)
					->with('customer', $customer)
					->with('product', $product);
	}

	public function inventory_issuance($window)
	{
		$contact = $this->contact_data();

		$product = $this->product_data();

		$department = $this->department_data();

		return $this->myViewLoader($window)
					->with('contact',$contact)
					->with('product',$product)
					->with('department',$department);
	}

	public function inventory_issuance_retrun($window)
	{
		return $this->myViewLoader($window);
	}

	public function inventory_stock_transfer($window)
	{
		return $this->myViewLoader($window);
	}

	public function inventory_product_listing($window)
	{
		return $this->myViewLoader($window);
	}

	public function inventory_product($window)
	{
		$collect = InventoryTableItemGroup::where('group_parent','0')->get();

		// return Arr::flatten($this->genaratingChildData($collect,'22'));
		$html = '<ul>';

		foreach (Arr::flatten($this->genaratingChildData($collect,'22')) as $value) {
			if($value != 'active') {
				$html .= '<li>' . $value . '</li>';
			}
		}

		$html .= '</ul>';

		// return $this->genaratingChildData($collect,'22');

		return $this->myViewLoader($window, $this->product_group_data())->with('product_data', $this->product_data());
	}

	public function inventory_product_group($window)
	{
		return $this->myViewLoader($window, $this->product_group_data());
	}

	public function inventory_department($window)
	{
		$department = $this->department_data();

		return $this->myViewLoader($window)->with('department',$department);
	}

	public function inventory_warehouse($window)
	{
		$warehouse = $this->warehouse_data();

		return $this->myViewLoader($window)->with('warehouse',$warehouse);
	}

	public function inventory_unit_measure($window)
	{
		$unit = $this->unit_data();

		return $this->myViewLoader($window)->with('unit',$unit);
	}

	public function inventory_variation($window)
	{
		return $this->myViewLoader($window);
	}

	public function inventory_address($window)
	{
		$address = $this->address_data();

		return $this->myViewLoader($window)->with('address',$address);
	}

	public function inventory_contact($window)
	{
		$address = $this->address_data();
		$contact = $this->contact_data();

		return $this->myViewLoader($window)
					->with('address',$address)
					->with('contact',$contact);
	}

	public function inventory_supplier($window)
	{
		$address  = $this->address_data();
		$contact  = $this->contact_data();
		$supplier = $this->supplier_data();
		$currency = $this->currency_data();

		return $this->myViewLoader($window)
					->with('address',$address)
					->with('contact',$contact)
					->with('currency',$currency)
					->with('supplier',$supplier);
	}

	public function inventory_customer($window)
	{
		$address  = $this->address_data();
		$contact  = $this->contact_data();
		$customer = $this->customer_data();
		$currency = $this->currency_data();

		return $this->myViewLoader($window)
					->with('address',$address)
					->with('contact',$contact)
					->with('currency',$currency)
					->with('customer',$customer);
	}
}