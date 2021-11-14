<?php 

namespace App\Model\Maintenance;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Accounts\UsersBillingAddress;
use App\Model\Settings\SystemInvoice;

class UsersTableAddress extends Model
{
    protected $table = 'users_tbl_address';

    protected $primaryKey = 'address_id';

    public $timestamps = false;
}