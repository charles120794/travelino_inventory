<?php

namespace App\Http\Traits\Modules\Inventory;

use DB;
use Cache;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableItemGroup;
use Illuminate\Support\Arr;
use App\Model\Inventory\maintenance\InventoryTableCustomer;

trait InventoryWindowLoaderTrait
{
	public function inventory_dashboard($window)
	{
		$date_range = (request()->has('df') && request()->has('dt')) ? 
							date('F d, Y', strtotime(request()->get('df'))) . ' - ' . date('F d, Y',strtotime(request()->get('dt'))) : 
							date('F d, Y') ;

		$total_expense = $this->inventory_cashier_total_purchase();
		$total_revenue = $this->inventory_cashier_total_selling();
		$total_vat_amt = $this->inventory_cashier_total_vat_amount();
		$total_profits = $this->inventory_cashier_total_vatable();
		$total_gross_a = $this->inventory_cashier_total_gross();
		$total_qty_sol = $this->inventory_cashier_total_quantity_sold();
		$total_qty_cos = $this->inventory_cashier_total_qty_sold_cost();
		$total_qty_pri = $this->inventory_cashier_total_qty_sold_price();

		return $this->myViewLoader($window)
					->with('total_expense', $total_expense)
					->with('total_revenue', $total_revenue)
					->with('total_vat_amt', $total_vat_amt)
					->with('total_profits', $total_profits)
					->with('total_gross_a', $total_gross_a)
					->with('total_qty_sol', $total_qty_sol)
					->with('total_qty_cos', $total_qty_cos)
					->with('total_qty_pri', $total_qty_pri)
					->with('date_range', $date_range);
	}

	public function inventory_cashier($window)
	{
		$products = $this->product_data();
		$currency = $this->currency_data();
		$customer = $this->inventory_retrieve_customer();

		return $this->myViewLoader($window)
					->with('product',  $products)
					->with('customer', $customer)
					->with('currency', $currency);
	}

	public function inventory_order($window)
	{
		$products = $this->product_data();
		$currency = $this->currency_data();
		$customer = $this->inventory_retrieve_customer();

		return $this->myViewLoader($window)
					->with('product',  $products)
					->with('customer', $customer)
					->with('currency', $currency);
	}

	public function inventory_issuance($window)
	{
		$contact    = $this->contact_data();
		$product    = $this->product_data();
		$department = $this->department_data();

		return $this->myViewLoader($window)
					->with('contact',   $contact)
					->with('product',   $product)
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
		$currency = $this->currency_data();
		$customer = $this->CustomPaginate($this->inventory_retrieve_customer());

		return $this->myViewLoader($window)
					->with('address',$address)
					->with('contact',$contact)
					->with('currency',$currency)
					->with('customer',$customer);
	}

	public function inventory_reports($window)
	{
		$total_income = $this->inventory_cashier_total_purchases_price();
		$total_expense = $this->inventory_cashier_total_expenses_price();

		return $this->myViewLoader($window)
					->with('total_income',$total_income)
					->with('total_expense',$total_expense);
	}
}