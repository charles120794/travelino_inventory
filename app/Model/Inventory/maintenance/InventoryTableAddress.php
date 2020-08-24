<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableAddress extends Model
{

	protected $table = 'inv_tbl_address';

	protected $primaryKey = 'address_id';

	public $timestamps = false;

}