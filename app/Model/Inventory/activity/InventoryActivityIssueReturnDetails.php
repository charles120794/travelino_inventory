<?php 

namespace App\Model\Inventory\activity;

use Illuminate\Database\Eloquent\Model;

class InventoryActivityIssueReturnDetails extends Model
{

	protected $table = 'inv_act_issue_return_details';

	protected $primaryKey = 'detail_id';

	public $timestamps = false;

}