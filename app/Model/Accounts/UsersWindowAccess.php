<?php

namespace App\Model\Accounts;

use App\User;
use App\Model\Settings\SystemWindow;
use App\Model\Settings\SystemModule;

use Illuminate\Database\Eloquent\Model;

class UsersWindowAccess extends Model
{

    protected $table = 'users_window';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function systemSubClass()
    {
        return $this->hasMany(UsersWindowAccess::class, 'menu_parent', 'menu_id');
    }

    public function systemWindow()
    {
        return $this->hasOne(SystemWindow::class, 'menu_id', 'menu_id');
    }

    public function categories()
    {
        return $this->hasMany(UsersWindowAccess::class, 'menu_id', 'menu_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(UsersWindowAccess::class, 'menu_id', 'menu_id')->with('categories');
    }

}
