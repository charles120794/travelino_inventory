<?php

namespace App\Model\Accounts;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UsersAddress extends Model
{

    protected $table = 'users_address';

    protected $primaryKey = 'address_id';

    public $timestamps = false;

    public function usersInfo()
    {
        return $this->belongsTo(User::class,'users_address','address_id');
    }
}