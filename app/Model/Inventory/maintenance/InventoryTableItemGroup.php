<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableItemGroup extends Model
{

	protected $table = 'inv_tbl_item_group';

	protected $primaryKey = 'group_id';

	public $timestamps = false;

	public function groupParent()
	{
		return $this->belongsTo(new InventoryTableItemGroup,'group_parent','group_id')->with('groupParent')->orderBy('order_level','asc');
	}

	public function groupDetails()
	{
		return $this->hasMany(new InventoryTableItemGroup,'group_parent','group_id')->orderBy('order_level','asc');
	}

}