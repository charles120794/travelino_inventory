<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemMediaExtension extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_media_extension';

    protected $primaryKey = 'extension_id';

    public $timestamps = false;

}
