<?php 

namespace App\Model\Inventory\activity;

use Illuminate\Database\Eloquent\Model;

class InventoryActivityIssueReturn extends Model
{

	protected $table = 'inv_act_issue_return';

	protected $primaryKey = 'return_id';

	public $timestamps = false;

}