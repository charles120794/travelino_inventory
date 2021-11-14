<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemWindow;
use App\Model\Settings\SystemModule;
use App\Model\Settings\SystemCompany;

use Illuminate\Database\Eloquent\Model;

class UsersWindowAccess extends Model
{
    protected $table = 'users_access_window';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function systemWindow()
    {
        return $this->hasOne(SystemWindow::class,'window_code','access_window_code');
    }

    public function systemWindowCategory()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_window_code','access_window_code_parent');
    }

    public function systemWindowSubCategory()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_window_code','access_window_code_parent')->with('systemWindowCategory');
    }

    public function userInfo()
    {
        return $this->hasOne(User::class, 'users_id', 'users_id');
    }

    public function moduleInfo()
    {
        return $this->hasOne(SystemModule::class,'module_id','access_module_id');
    }

    public function windowInfo()
    {
        return $this->hasOne(SystemWindow::class,'window_code','access_window_code');
    }

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class,'company_id','access_company_id');
    }
}
