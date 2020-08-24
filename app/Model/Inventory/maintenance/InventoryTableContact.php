<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableContact extends Model
{

	protected $table = 'inv_tbl_contact';

	protected $primaryKey = 'contact_id';

	public $timestamps = false;

}