<?php 

namespace App\Model\Inventory\Activity;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryActivityBasket extends Model
{

	protected $table = 'inv_tbl_basket';

	protected $primaryKey = 'basket_id';

	public $timestamps = false;

}