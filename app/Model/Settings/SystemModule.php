<?php

namespace App\Model\Settings;

use App\Model\Accounts\UsersModuleAccess;

use Illuminate\Database\Eloquent\Model;

class SystemModule extends Model
{
    
    // protected $connection = 'settings';

    protected $table = 'system_module';

    protected $primaryKey = 'module_id';

    public $timestamps = false;

    public function usersModuleAccessInfo()
    {
        return $this->hasMany(UsersModuleAccess::class,'module_id','module_id');
    }

    public function moduleGroupInfo()
    {
    	return $this->belongsTo(SystemModuleGroup::class,'group_id','group_id');
    }

    public function windowInfo()
    {
        return $this->hasMany(SystemWindow::class,'module_id','module_id');
    }

    public function windowMethodInfo()
    {
        return $this->hasMany(SystemWindowMethod::class,'module_id','module_id');
    }

}
