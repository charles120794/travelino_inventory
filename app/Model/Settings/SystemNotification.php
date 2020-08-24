<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_notification';

    protected $primaryKey = 'notif_id';

    public $timestamps = false;
    
}