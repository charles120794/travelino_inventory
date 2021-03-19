<?php 

namespace App\Model\Inventory\maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Inventory\Activity\InventoryActivityIssue;

class InventoryTableDepartment extends Model
{

	protected $table = 'inv_tbl_department';

	protected $primaryKey = 'department_id';

	public $timestamps = false;

	public function productDepartment()
	{
		return $this->hasMany(new InventoryActivityIssue,'issue_department','department_id');
	}

}