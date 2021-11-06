<?php

use Illuminate\Database\Seeder;

class SystemAuditTrailSeeder extends Seeder
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
        // $this->databaseConnection()->table('system_audit_trail')->insert([
        //     'users_id' => 1,
        //     'module_id' => 1,
        //     'window_id' => 1,
        //     'control_id' => 1,
        //     'ip_address' => '127.0.0.1',
        //     'remarks' => 'Successfully Login to Inventory Module',
        //     'audit_date' => now(),
        // ]);
    }
}
