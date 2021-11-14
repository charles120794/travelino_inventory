<?php

namespace App;

use App\Model\Settings\SystemCompany;

use App\Model\Accounts\UsersModuleAccess;
use App\Model\Accounts\UsersWindowAccess;
use App\Model\Accounts\UsersCompanyAccess;
use App\Model\Accounts\UsersAddressAccess;
use App\Model\Accounts\UsersWindowMethodAccess;

use App\Model\Maintenance\UsersTableAddress;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
    
    public $timestamps = false;

    // public function setEmailAttribute($value)
    // {
    //     $this->attributes['personal_email'] = $value;
    // }

    public function getFullNameAttribute($value)
    {
        // return $value->status + $value->order_level + $value->number;
    }

    

    /**
     * For Users Access Information
     */
    public function companyAccess()
    {
        return $this->hasMany(UsersCompanyAccess::class,'access_users_id','users_id')->with('companyInfo');
    }

    public function companyDefaultAccess()
    {
        return $this->hasOne(UsersCompanyAccess::class,'access_users_id','users_id')->where('access_company_default', 1);
    }

    public function moduleAccess($companyID = null)
    {
        $module = $this->hasMany(UsersModuleAccess::class,'access_users_id','users_id')->with('moduleInfo');

        if( !is_null($companyID) ) {
            $module = $module->where('access_company_id', $companyID);
        }

        return $module;
    }

    public function moduleDefaultAccess()
    {
        return $this->hasOne(UsersModuleAccess::class,'access_users_id','users_id')->where('access_module_default', 1);;
    }

    /**
     * Access with no default value
     */
    public function windowAccess()
    {
        return $this->hasMany(UsersWindowAccess::class,'access_users_id','users_id')->with('windowInfo');
    }

    public function windowMethodAccess()
    {
        return $this->hasMany(UsersWindowMethodAccess::class,'access_users_id','users_id')->with('windowMethodInfo');
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
        return $this->hasMany(UsersAddressAccess::class,'access_users_id','users_id')->where('address_default', 1);
    }

    // public function billingInfo()
    // {
    //     return $this->hasOne(TableConsumer::class,'access_users_id','users_id');
    // }

    // public function usersBillingAddress()
    // {
    //     return $this->hasOne(UsersBillingAddress::class,'address_id','users_address');
    // }
}
