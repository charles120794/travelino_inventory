<?php

namespace App\Model\Subscription;

use Illuminate\Database\Eloquent\Model;

class SystemVerification extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_verification';

    protected $primaryKey = 'notif_id';

    public $timestamps = false;
    
}