<?php 

namespace App\Model\Inventory\Activity;

use App\User;
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

}