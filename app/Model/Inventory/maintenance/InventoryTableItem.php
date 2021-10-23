<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Inventory\activity\InventoryActivityCashierDetails;
use App\Model\Inventory\activity\InventoryActivityBasket;

class InventoryTableItem extends Model
{

	protected $table = 'inv_tbl_item';

	protected $primaryKey = 'item_id';

	protected $appends = [
		'item_quantity_remaining',
	];

	public $timestamps = false;

	public function getItemQuantityRemainingAttribute()
    {
    	$baskets = $this->itemBasket();
    	$cashier = $this->itemQuantity();

        $cashier->whereHas('cashier', function($query){
        	$query->where('cashier_status_order','paid');
        	$query->whereIn('cashier_purchase_type', ['purchase','order']);
		});

    	return $this->attributes['item_quantity'] - $cashier->sum('cashier_quantity') - $baskets->sum('basket_item_quantity_new');
    }

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

	public function itemQuantity()
	{
		return $this->hasMany(new InventoryActivityCashierDetails,'cashier_item','item_id');
	}

	public function itemBasket()
	{
		return $this->hasMany(new InventoryActivityBasket,'basket_item_id','item_id');
	}

	// public function itemBasketTotalQuantity()
	// {
	// 	return $this->itemBasket()->get()->sum('basket_item_quantity_new');
	// }

	public function itemCashier()
	{
		return $this->hasMany(new InventoryActivityCashierDetails,'cashier_item','item_id');
	}

	public function itemSupplier()
	{
		return $this->hasOne(new InventoryTableSupplier,'supplier_id','item_supplier');
	}

}