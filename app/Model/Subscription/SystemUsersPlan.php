<?php

namespace App\Model\Subscription;

use Illuminate\Database\Eloquent\Model;

class SystemUsersPlan extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_users_plan';

    protected $primaryKey = 'plan_id';

    public $timestamps = false;
    
}
