<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemModule;

use Illuminate\Database\Eloquent\Model;

class UsersModuleAccess extends Model
{

    // protected $connection = 'settings';

    protected $table = 'users_module';

    protected $primaryKey = 'users_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function moduleInfo()
    {
        return $this->hasOne(SystemModule::class, 'module_id', 'module_id');
    }

}
