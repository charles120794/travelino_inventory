<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableCustomer extends Model
{

	protected $table = 'inv_tbl_customer';

	protected $primaryKey = 'customer_id';

	public $timestamps = false;

	public function customerAddress()
	{
		return $this->hasOne(new InventoryTableAddress,'address_id','customer_address');
	}

	public function customerContact()
	{
		return $this->hasOne(new InventoryTableContact,'contact_id','customer_contact');
	}

}