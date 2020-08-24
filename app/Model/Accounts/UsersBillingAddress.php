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

    public function usersBillingInfo()
    {
        return $this->belongsTo(UsersBilling::class, 'consumer_address','address_id');
    }

}