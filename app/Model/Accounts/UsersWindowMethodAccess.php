<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemWindowMethod;

use Illuminate\Database\Eloquent\Model;

class UsersWindowMethodAccess extends Model
{

    // protected $connection = 'settings';

    protected $table = 'users_window_method';

    protected $primaryKey = 'users_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
    
}