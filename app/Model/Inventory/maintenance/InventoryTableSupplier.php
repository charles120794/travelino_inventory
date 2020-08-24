<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableSupplier extends Model
{

	protected $table = 'inv_tbl_supplier';

	protected $primaryKey = 'supplier_id';

	public $timestamps = false;

}