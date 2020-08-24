<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemModule;

use Illuminate\Database\Eloquent\Model;

class UsersBilling extends Model
{

    // protected $connection = 'settings';

    protected $table = 'table_consumer';

    protected $primaryKey = 'users_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->hasOne(User::class, 'users_id', 'users_id');
    }

    public function userAddressInfo()
    {
        return $this->hasOne(UsersBillingAddress::class, 'address_id', 'consumer_address');
    }

}