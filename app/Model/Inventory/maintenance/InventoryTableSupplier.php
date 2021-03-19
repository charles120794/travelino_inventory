<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableSupplier extends Model
{

	protected $table = 'inv_tbl_supplier';

	protected $primaryKey = 'supplier_id';

	public $timestamps = false;

	public function supplierAddress()
	{
		return $this->hasOne(new InventoryTableAddress,'address_id','supplier_address');
	}

	public function supplierContact()
	{
		return $this->hasOne(new InventoryTableContact,'contact_id','supplier_contact');
	}

}