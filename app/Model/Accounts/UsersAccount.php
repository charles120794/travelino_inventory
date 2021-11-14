<?php

namespace App\Model\Accounts;

use App\Model\Settings\SystemCompany;

use App\Model\Accounts\UsersModuleAccess;
use App\Model\Accounts\UsersWindowAccess;
use App\Model\Accounts\UsersCompanyAccess;
use App\Model\Accounts\UsersAddressAccess;
use App\Model\Accounts\UsersWindowMethodAccess;

use App\Model\Maintenance\UsersTableAddress;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersAccount extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'is_admin' => 'boolean',
        // 'created_date' => 'F d, Y',
    ];

    public $primaryKey = 'users_id';

    public function moduleAccess()
    {
        return $this->hasMany(UsersModuleAccess::class,'access_users_id','users_id');
    }

    public function companyAccess()
    {
        return $this->hasMany(UsersCompanyAccess::class,'access_users_id','users_id');
    }
    
    public function windowAccess()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_users_id','users_id');
    }

    public function windowMethodAccess()
    {
        return $this->hasMany(UsersWindowMethodAccess::class,'access_users_id','users_id');
    }

    /**
     * For Users Company Information
     */
    public function usersCompanyInfo()
    {
        return $this->hasMany(UsersCompanyAccess::class,'access_users_id','users_id');
    }

    public function usersDefaultcompanyInfo()
    {
        return $this->hasMany(UsersCompanyAccess::class,'access_users_id','users_id')->where('access_company_default', 1);
    }

    /**
     * For Users Address Information
     */
    public function usersAddress()
    {
        return $this->hasMany(UsersAddressAccess::class,'access_users_id','users_id');
    }

    public function usersDefaltAddress()
    {
        return $this->hasMany(UsersAddressAccess::class,'access_users_id','users_id')->where('access_address_default', 1);
    }

    // public function billingInfo()
    // {
    //     return $this->hasOne(TableConsumer::class,'users_id','users_id');
    // }

    // public function usersBillingAddress()
    // {
    //     return $this->hasOne(UsersBillingAddress::class,'address_id','users_address');
    // }
}
