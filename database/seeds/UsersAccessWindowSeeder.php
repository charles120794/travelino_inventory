<?php

use Illuminate\Database\Seeder;

class UsersAccessWindowSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    protected function databaseConnection()
    {
        return DB::connection('mysql');
    }

    public function run()
    {
        $this->databaseConnection()->table('users_access_window')->insert(
            $this->for_app_manager()
        );

        $this->databaseConnection()->table('users_access_window')->insert(
            $this->for_acc_manager()
        );
    }

    protected function for_app_manager()
    {
        return array(
            array(
                "access_users_id" => 1,
                "access_module_id" => 1,
                "access_company_id" => 1,
                "access_window_code" => 'APP00001',
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => 'Dashboard',
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 1,
                "access_company_id" => 1,
                "access_window_code" => 'APP00002',
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => 'App Company',
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 1,
                "access_company_id" => 1,
                "access_window_code" => 'APP00003',
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => 'App Modules',
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 1,
                "access_company_id" => 1,
                "access_window_code" => 'APP00004',
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => 'App Windows',
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 1,
                "access_company_id" => 1,
                "access_window_code" => 'APP00005',
                "access_window_code_parent" => 0,
                "access_window_level" => 1,
                "access_window_name" => 'Method & Action',
                "access_window_type" => 0,
            ),
        );
    }

    protected function for_acc_manager()
    {
        return array(
            array(
                "access_users_id" => 1,
                "access_module_id" => 2,
                "access_company_id" => 1,
                "access_window_code" => "ACC00001",
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => "Dashboard",
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 2,
                "access_company_id" => 1,
                "access_window_code" => "ACC00002",
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => "Users Table",
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 2,
                "access_company_id" => 1,
                "access_window_code" => "ACC00003",
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => "Users Window",
                "access_window_type" => 0,
            ),
            array(
                "access_users_id" => 1,
                "access_module_id" => 2,
                "access_company_id" => 1,
                "access_window_code" => "ACC00004",
                "access_window_code_parent" => NULL,
                "access_window_level" => 1,
                "access_window_name" => "Users Profile",
                "access_window_type" => 0,
            ),
        );
    }
}
