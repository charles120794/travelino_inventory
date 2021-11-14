<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemWindow;
use App\Model\Settings\SystemModule;
use App\Model\Settings\SystemCompany;
use App\Model\Settings\SystemWindowMethod;

use Illuminate\Database\Eloquent\Model;

class UsersWindowMethodAccess extends Model
{
    protected $table = 'users_access_window_method';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function windowMethodInfo()
    {
        return $this->hasOne(SystemWindowMethod::class,'window_method_code','access_window_method_code');
    }

    public function userInfo()
    {
        return $this->hasOne(User::class, 'users_id', 'users_id');
    }

    public function moduleInfo()
    {
        return $this->hasOne(SystemModule::class,'module_id','access_module_id');
    }

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class,'company_id','access_company_id');
    }
}