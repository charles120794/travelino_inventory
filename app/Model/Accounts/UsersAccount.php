<?php

namespace App\Model\Accounts;

use App\Model\Settings\SystemCompany;

use App\Model\Accounts\UsersModuleAccess;
use App\Model\Accounts\UsersWindowAccess;
use App\Model\Accounts\UsersCompanyAccess;
use App\Model\Accounts\UsersWindowMethodAccess;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Model\Tables\TableConsumer;

class UsersAccount extends Authenticatable
{

    // protected $connection = 'settings';

    protected $table = 'users';

    protected $primaryKey = 'users_id';
   
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public $timestamps = false;

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class,'company_id','company_id');
    }

    public function moduleAccess()
    {
        return $this->hasMany(UsersModuleAccess::class,'users_id','users_id');
    }

    public function windowAccess()
    {
        return $this->hasMany(UsersWindowAccess::class,'users_id','users_id');
    }

    public function companyAccess()
    {
        return $this->hasMany(UsersCompanyAccess::class,'users_id','users_id');
    }

    public function windowMethodAccess()
    {
        return $this->hasMany(UsersWindowMethodAccess::class,'users_id','users_id');
    }       

    public function billingInfo()
    {
        return $this->hasOne(TableConsumer::class,'users_id','users_id');
    }

    public function addressInfo()
    {
        return $this->hasMany(UsersBillingAddress::class,'users_id','users_id');
    }

    public function addressPersonalInfo()
    {
        return $this->hasOne(UsersBillingAddress::class,'address_id','personal_address_id');
    }
    
}
