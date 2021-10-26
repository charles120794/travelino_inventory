<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemModule;

use Illuminate\Database\Eloquent\Model;

class UsersBillingAddress extends Model
{

    // protected $connection = 'settings';

    protected $table = 'table_address';

    protected $primaryKey = 'address_id';

    public $timestamps = false;

    public function usersInfo()
    {
        return $this->hasOne(User::class,'users_address','address_id');
    }
}