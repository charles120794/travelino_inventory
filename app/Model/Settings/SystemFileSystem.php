<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemFileSystem extends Model
{
    protected $table = 'system_file_system';

    protected $primaryKey = 'file_id';

    public $timestamps = false;
}