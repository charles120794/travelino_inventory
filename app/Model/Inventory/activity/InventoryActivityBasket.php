<?php 

namespace App\Model\Inventory\activity;

use Illuminate\Database\Eloquent\Model;
use App\Model\Inventory\maintenance\InventoryTableUnit;
use App\Model\Inventory\maintenance\InventoryTableItem;

class InventoryActivityBasket extends Model
{

	protected $table = 'inv_tbl_basket';

	protected $primaryKey = 'basket_id';

	public $timestamps = false;

	public function itemCode()
	{
		return $this->hasOne(new InventoryTableItem,'item_id','basket_item_id');
	}

	public function itemUnit()
	{
		return $this->hasOne(new InventoryTableUnit,'unit_id','basket_item_unit_id');
	}

}