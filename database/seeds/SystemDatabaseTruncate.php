<?php

use Illuminate\Database\Seeder;

class SystemDatabaseTruncate extends Seeder
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
        // $this->databaseConnection()->table('system_window_method')->truncate();
        // $this->databaseConnection()->table('system_window')->truncate();
        // $this->databaseConnection()->table('system_module')->truncate();
        // $this->databaseConnection()->table('system_module_group')->truncate();
        // $this->databaseConnection()->table('system_company_module')->truncate();
        // $this->databaseConnection()->table('system_company')->truncate();
        // $this->databaseConnection()->table('system_control_date')->truncate();
    }
}