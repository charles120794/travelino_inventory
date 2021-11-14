<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemModule;

use Illuminate\Database\Eloquent\Model;

class UsersModuleAccess extends Model
{
    protected $table = 'users_access_module';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class,'users_id','users_id');
    }

    public function moduleInfo()
    {
        return $this->hasOne(SystemModule::class,'module_id','access_module_id');
    }
}
