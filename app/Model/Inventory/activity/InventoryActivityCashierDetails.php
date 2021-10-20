<?php 

namespace App\Model\Inventory\activity;

use App\Model\Inventory\maintenance\InventoryTableUnit;
use App\Model\Inventory\maintenance\InventoryTableItem;

use Illuminate\Database\Eloquent\Model;

class InventoryActivityCashierDetails extends Model
{

	protected $table = 'inv_tbl_cashier_details';

	protected $primaryKey = 'cashier_id';

	public $timestamps = false;

	public function cashierItemUnit()
	{
		return $this->hasOne(new InventoryTableUnit,'unit_id','cashier_unit_id');
	}

	public function cashier()
	{
		return $this->belongsTo(new InventoryActivityCashier,'cashier_id','cashier_id');
	}

	public function products()
	{
		return $this->belongsTo(new InventoryTableItem,'item_id','cashier_item');
	}

}