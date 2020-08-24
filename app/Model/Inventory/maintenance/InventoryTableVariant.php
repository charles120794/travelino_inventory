<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableVariant extends Model
{

	protected $table = 'inv_tbl_variant';

	protected $primaryKey = 'variant_id';

	public $timestamps = false;

}