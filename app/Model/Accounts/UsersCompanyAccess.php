<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemCompany;

use Illuminate\Database\Eloquent\Model;

class UsersCompanyAccess extends Model
{

    // protected $connection = 'settings';

    protected $table = 'users_company';

    protected $primaryKey = 'users_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class, 'company_id', 'company_id');
    }
    
}