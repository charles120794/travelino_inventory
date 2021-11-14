<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemControlDate extends Model
{
    protected $table = 'system_control_date';

    protected $primaryKey = 'control_id';

    public $timestamps = false;
}
