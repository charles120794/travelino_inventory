<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableCurrency extends Model
{

	protected $table = 'inv_tbl_currency';

	protected $primaryKey = 'currency_id';

	public $timestamps = false;

}