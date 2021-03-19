<?php 

namespace App\Model\Inventory\Activity;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InventoryActivityIssue extends Model
{

	protected $table = 'inv_act_issue';

	protected $primaryKey = 'issue_id';

	public $timestamps = false;

}