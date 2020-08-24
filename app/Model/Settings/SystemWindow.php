<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Model\Accounts\UsersWindowAccess;

class SystemWindow extends Model
{
    
    // protected $connection = 'travelino';

    protected $table = 'system_window';

    protected $primaryKey = 'menu_id';

    public $timestamps = false;

    public function subClass()
    {
        return $this->hasMany(SystemWindow::class,'menu_parent','menu_id')->with('parentClass');
    }

    public function subClassWindow()
    {
        return $this->hasMany(SystemWindow::class,'menu_parent','menu_id')->with('subClassWindow');
    }
     
    public function subClassMethod()
    {
        return $this->hasMany(SystemWindowMethod::class,'menu_id','menu_id');
    }

    public function windowMethodInfo()
    {
        return $this->hasMany(SystemWindowMethod::class,'menu_id','menu_id');
    }

    public function parentClass()
    {
        return $this->belongsTo(SystemWindow::class,'menu_parent','menu_id');
    }

    public function activeWindow($module_id = null)
    {
        
        $query = $this->where('menu_status','1')->orderBy('menu_parent','asc')->orderBy('menu_level','asc')->orderBy('order_level','asc');

        if(!is_null($module_id))
        {
            $query = $query->where('module_id', $module_id);
        }

        if(!is_null(request()->filterLevel))
        {
            $query = $query->where('menu_level',request()->filterLevel);
        }

        if(!is_null(request()->filterClass))
        {
            $query = $query->where('menu_parent',request()->filterClass);
        }

        if(!is_null(request()->filterIcon))
        {
            $query = $query->where('menu_icon','LIKE',request()->filterIcon.'%');
        }

        if(!is_null(request()->filterDescription))
        {
            $query = $query->where('menu_name','LIKE',request()->filterDescription.'%');
        }

        if(!is_null(request()->filterPath))
        {
            $query = $query->where('menu_path','LIKE',request()->filterPath.'%');
        }

        return $query;
    }

    public function usersAccess()
    {
        return $this->hasOne(UsersWindowAccess::class,'menu_id', 'menu_id');
    }
   
}
