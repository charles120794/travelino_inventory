<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Model\Settings\SystemCompany;

use App\Model\Accounts\UsersAddress;
use App\Model\Accounts\UsersModuleAccess;
use App\Model\Accounts\UsersWindowAccess;
use App\Model\Accounts\UsersCompanyAccess;
use App\Model\Accounts\UsersWindowMethodAccess;

use App\Model\Tables\TableConsumer;
use App\Model\Accounts\UsersBillingAddress;

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
    
    // public $timestamps = false;

    // public function setEmailAttribute($value)
    // {
    //     $this->attributes['personal_email'] = $value;
    // }

    public function getFullNameAttribute($value)
    {
        // return $value->status + $value->order_level + $value->number;
    }

    public function companyInfo()
    {
        return $this->hasOne(SystemCompany::class,'company_id','company_id');
    }

    public function companyAccess()
    {
        return $this->hasMany(UsersCompanyAccess::class,'users_id','users_id');
    }

    public function moduleAccess()
    {
        return $this->hasMany(UsersModuleAccess::class,'users_id','users_id');
    }

    public function windowAccess()
    {
        return $this->hasMany(UsersWindowAccess::class,'users_id','users_id');
    }

    public function windowMethodAccess()
    {
        return $this->hasMany(UsersWindowMethodAccess::class,'users_id','users_id');
    }

    public function billingInfo()
    {
        return $this->hasOne(TableConsumer::class,'users_id','users_id');
    }

    public function usersAddress()
    {
        return $this->hasOne(UsersAddress::class,'address_id','users_address');
    }

    public function usersBillingAddress()
    {
        return $this->hasOne(UsersBillingAddress::class,'address_id','users_address');
    }
}
