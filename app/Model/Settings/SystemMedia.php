<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemMedia extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_media';

    protected $primaryKey = 'media_id';

    public $timestamps = false;

}