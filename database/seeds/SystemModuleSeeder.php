<?php

use Illuminate\Database\Seeder;

class SystemModuleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    protected function databaseConnection()
    {
        return DB::connection('mysql_test');
    }

    public function run()
    {
        $system_module = array(
            array(
                "module_id" => 1,
                "module_group" => 1,
                "module_code" => "MOD0001",
                "module_home" => "home",
                "module_name" => "APPLICATION MANAGER",
                "module_description" => "APPLICATION MANAGER",
                "module_prefix" => "settings",
                "module_sub_domain" => "settings",
                "module_class_icon" => "fa fa-dropbox",
                "module_class_design" => "bg-aqua",
                "module_redirect_route" => "settings.route",
                "module_type" => "free",
                "module_status" => "active",
                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2019-08-28 00:00:00",
            ),
            array(
                "module_id" => 2,
                "module_group" => 1,
                "module_code" => "MOD0002",
                "module_home" => "home",
                "module_name" => "ACCOUNT MANAGER",
                "module_description" => "ACCOUNT MANAGER",
                "module_prefix" => "accounts",
                "module_sub_domain" => "accounts",
                "module_class_icon" => "fa fa-dropbox",
                "module_class_design" => "bg-aqua",
                "module_redirect_route" => "accounts.route",
                "module_type" => "free",
                "module_status" => "active",
                "status" => 1,
                "order_level" => 2,
                "created_by" => 1,
                "created_date" => "2020-03-08 19:07:14",
            ),
            array(
                "module_id" => 3,
                "module_group" => 1,
                "module_code" => "MOD0003",
                "module_home" => "home",
                "module_name" => "INVENTORY SYSTEM",
                "module_description" => "INVENTORY SYSTEM",
                "module_prefix" => "inventory",
                "module_sub_domain" => "inventory",
                "module_class_icon" => "fa fa-dropbox",
                "module_class_design" => "bg-aqua",
                "module_redirect_route" => "inventory.route",
                "module_type" => "free",
                "module_status" => "active",
                "status" => 1,
                "order_level" => 2,
                "created_by" => 1,
                "created_date" => "2019-12-17 09:30:48",
            ),
            array(
                "module_id" => 4,
                "module_group" => 1,
                "module_code" => "MOD0004",
                "module_home" => "home",
                "module_name" => "FILESYSTEM SYSTEM",
                "module_description" => "FILESYSTEM SYSTEM",
                "module_prefix" => "filesystem",
                "module_sub_domain" => "filesystem",
                "module_class_icon" => "fa fa-dropbox",
                "module_class_design" => "bg-aqua",
                "module_redirect_route" => "filesystem.route",
                "module_type" => "free",
                "module_status" => "active",
                "status" => 1,
                "order_level" => 2,
                "created_by" => 1,
                "created_date" => "2021-11-06 08:33:48",
            ),
        );

        $this->databaseConnection()->table('system_module')->insert($system_module);
    }
}
