<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableWarehouse extends Model
{

	protected $table = 'inv_tbl_warehouse';

	protected $primaryKey = 'warehouse_id';

	public $timestamps = false;

}