<?php 

namespace App\Model\Inventory\Activity;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Inventory\maintenance\InventoryTableItem;

class InventoryActivityCashierDetails extends Model
{

	protected $table = 'inv_tbl_cashier_details';

	protected $primaryKey = 'cashier_id';

	public $timestamps = false;

	public function cashier()
	{
		return $this->belongsTo(new InventoryActivityCashier,'cashier_id','cashier_id');
	}

	public function products()
	{
		return $this->belongsTo(new InventoryTableItem,'item_id','cashier_item');
	}

}