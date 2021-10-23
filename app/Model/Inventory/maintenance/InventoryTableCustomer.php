<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

use App\Model\Inventory\activity\InventoryActivityCashier;

class InventoryTableCustomer extends Model
{

	protected $table = 'inv_tbl_customer';

	protected $primaryKey = 'customer_id';

	public $timestamps = false;

	public function customerCashier()
	{
		return $this->hasMany(new InventoryActivityCashier,'cashier_customer_id','customer_id');
	}

	public function customerContact()
	{
		return $this->hasOne(new InventoryTableContact,'contact_id','customer_contact');
	}

	public function customerAddress()
	{
		return $this->hasOne(new InventoryTableAddress,'address_id','customer_address');
	}
	
}