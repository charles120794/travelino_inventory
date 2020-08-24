<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableItemImages extends Model
{

	protected $table = 'inv_tbl_item_images';

	protected $primaryKey = 'image_id';

	public $timestamps = false;

}