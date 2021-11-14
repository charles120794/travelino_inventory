<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Maintenance\UsersTableAddress;
use Illuminate\Database\Eloquent\Model;

class UsersAddressAccess extends Model
{
    protected $table = 'users_access_address';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function usersInfo()
    {
        return $this->belongsTo(User::class,'users_id','access_users_id');
    }

    public function usersAddressInfo()
    {
        return $this->hasOne(UsersTableAddress::class,'address_id','access_address_id');
    }
}