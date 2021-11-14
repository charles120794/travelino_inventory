<?php

namespace App\Model\Settings;

use App\Model\Accounts\UsersModuleAccess;
use App\Model\Accounts\UsersWindowAccess;
use App\Model\Accounts\UsersWindowMethodAccess;

use App\Model\Settings\SystemModuleGroup;
use App\Model\Settings\SystemWindow;
use App\Model\Settings\SystemWindowMethod;

use Illuminate\Database\Eloquent\Model;

class SystemModule extends Model
{
    protected $table = 'system_module';

    protected $primaryKey = 'module_id';

    public $timestamps = false;

    public function usersInfo()
    {
        return $this->hasMany(UsersModuleAccess::class,'access_module_id','module_id');
    }

    public function moduleGroupInfo()
    {
    	return $this->belongsTo(SystemModuleGroup::class,'group_id','module_group');
    }

    public function systemWindowInfo()
    {
        return $this->hasMany(SystemWindow::class,'window_module_id','module_id')->with('systemWindow');
    }

    public function systemWindowMethodInfo()
    {
        return $this->hasMany(SystemWindowMethod::class,'window_method_module_id','module_id');
    }

    public function usersAccessWindowInfo()
    {
        return $this->hasMany(UsersModuleAccess::class,'access_module_id','module_id');
    }

    public function usersAccessWindowMethodInfo()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_module_id','module_id');
    }
}
