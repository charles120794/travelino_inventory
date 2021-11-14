<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Model\Accounts\UsersWindowAccess;

class SystemWindow extends Model
{
    protected $table = 'system_window';

    protected $primaryKey = 'window_id';

    public $timestamps = false;

    public function systemWindow()
    {
        return $this->hasMany(SystemWindow::class,'window_code_parent','window_code');
    }

    public function systemWindowSubCategory()
    {
        return $this->hasMany(SystemWindow::class,'window_code_parent','window_code');
    }
     
    public function systemWindowMethod()
    {
        return $this->hasMany(SystemWindowMethod::class,'window_method_window_code','window_code');
    }

    public function systemWindowUsersAccess()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_window_code', 'window_code');
    }
}
