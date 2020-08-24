<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryTableDepartment extends Model
{

	protected $table = 'inv_tbl_department';

	protected $primaryKey = 'department_id';

	public $timestamps = false;

}