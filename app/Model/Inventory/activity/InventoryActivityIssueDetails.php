<?php 

namespace App\Model\Inventory\Activity;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryActivityIssueDetails extends Model
{

	protected $table = 'inv_act_issue_details';

	protected $primaryKey = 'detail_id';

	public $timestamps = false;

}