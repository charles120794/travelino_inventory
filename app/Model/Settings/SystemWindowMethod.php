<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemWindowMethod extends Model
{
    protected $table = 'system_window_method';

    protected $primaryKey = 'method_id';

    public $timestamps = false;

    public function systemWindow()
    {
        return $this->belongsTo(SystemWindow::class,'window_code','window_code_parent');
    }
}
