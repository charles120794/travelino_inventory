<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemCompany;

use Illuminate\Database\Eloquent\Model;

class UsersCompanyAccess extends Model
{
    protected $table = 'users_access_company';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->hasOne(User::class,'users_id','access_users_id');
    }

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class,'company_id','access_company_id');
    }
}