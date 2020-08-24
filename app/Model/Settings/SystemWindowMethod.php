<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemWindowMethod extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_window_method';

    protected $primaryKey = 'method_id';

    public $timestamps = false;

    public function systemWindow()
    {
        return $this->belongsTo(SystemWindow::class,'menu_id','menu_id');
    }
    
}
