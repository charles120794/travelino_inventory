<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableUnit extends Model
{

	protected $table = 'inv_tbl_unit';

	protected $primaryKey = 'unit_id';

	public $timestamps = false;

	public function productUnit()
	{
		return $this->hasMany(new InventoryTableItem,'item_unit','unit_id');
	}

}