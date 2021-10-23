<?php 

namespace App\Model\Inventory\activity;

use App\Model\Inventory\maintenance\InventoryTableCustomer;

use Illuminate\Database\Eloquent\Model;

class InventoryActivityCashier extends Model
{

	protected $table = 'inv_tbl_cashier';

	protected $primaryKey = 'cashier_id';

	public $timestamps = false;

	public function cashierDetails()
	{
		return $this->hasMany(new InventoryActivityCashierDetails,'cashier_id','cashier_id');
	}

	public function cashierCustomer()
	{
		return $this->hasOne(new InventoryTableCustomer,'customer_id','cashier_customer_id');
	}

}