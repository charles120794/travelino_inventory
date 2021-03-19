<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableItem extends Model
{

	protected $table = 'inv_tbl_item';

	protected $primaryKey = 'item_id';

	public $timestamps = false;

	public function itemGroup()
	{
		return $this->belongsTo(new InventoryTableItemGroup,'item_group','group_id')->with('groupParent');
	}

	public function itemImages()
	{
		return $this->hasMany(new InventoryTableItemImages,'image_item','item_id');
	}

	public function itemVariants()
	{
		return $this->hasMany(new InventoryTableVariant,'variant_item','item_id')->where('variant_parent','0')->where('variant_type', '1')->with('variantChild');
	}

	public function itemUnit()
	{
		return $this->hasOne(new InventoryTableUnit,'unit_id','item_unit');
	}

	public function itemSupplier()
	{
		return $this->hasOne(new InventoryTableSupplier,'supplier_id','item_supplier');
	}

}