<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemWindowTrait
{

    public function settings_create_system_window($method, $id = null, $request) 
    {

        $system_menu = app('SystemWindow')
                        ->where('menu_parent', $request->menu_parent)
                        ->where('menu_name', $request->menu_name);

        if($system_menu->count() > 0) {

            Session::flash('failed','This window is already exists, Please try again other menu \'class\', \'description\', \'path\', \'type\' ');
            return back()->withInput();

        } else {
      
            $array = collect([
                'module_id' => $request->module_id,
                'menu_name' => $request->menu_name,
                'menu_icon' => $request->menu_icon,
                'menu_path' => $request->menu_path,
                'menu_type' => $request->menu_type,
                'menu_parent' => $request->menu_parent,
            ]);

            $array = $array->merge($this->get_menu_level($request->menu_parent));
         
            if(app('SystemWindow')->insert($array->toArray())) {
                Session::flash('success','New users window successfully created.');
                return back();
            } else {
                Session::flash('success','Whoops! Something went wrong, please try again.');
                return back();
            }

        }

    }

    public function settings_update_system_window($method, $id = null, $request)
    {

        if(!is_null($request->window)) {

            foreach ($request->window as $key => $value) {

                if (array_key_exists('checkbox', $value)) {

                    $array = collect([
                        'menu_name'   => $value['menu_name'],
                        'menu_path'   => $value['menu_path'],
                        'menu_icon'   => $value['menu_icon'],
                        'menu_parent' => $value['menu_parent'],
                    ]);

                    $array = $array->merge($this->get_menu_level($value['menu_parent']));
                   
                    app('SystemWindow')->where('menu_id', decrypt($value['menu_id']))->update($array->toArray());

                }

                if( array_key_exists('menu_type', $value) ) { 

                    app('SystemWindow')->where('menu_id', decrypt($value['menu_id']))->update([
                        'menu_type' => 1, 
                    ]);

                } else {

                    app('SystemWindow')->where('menu_id', decrypt($value['menu_id']))->update([ 
                        'menu_type' => 0, 
                    ]);

                }

            }

            Session::flash('success','Window successfully Updated');
            return back();

        }

        return back();

    }

    protected function get_menu_level($menu_parent = 0)
    {
        if($menu_parent == 0) {

            $array = ['menu_level' => '1'];

        } else {

            $checker = app('SystemWindow')->where('menu_id', $menu_parent)->first();

            if($checker->menu_parent == 0 && $checker->menu_level == 1) {
                $array = ['menu_level' => '2'];
            } else {
                $array = ['menu_level' => ($checker->menu_level + 1)];
            }

        }

        return $array;

    }

    public function settings_delete_system_window($method, $id = null, $request)
    {
        // app('SystemWindow')->where('menu_id', $id)->update(['menu_status' => 0]); 
    }

}
//9Wfo8fCs?84