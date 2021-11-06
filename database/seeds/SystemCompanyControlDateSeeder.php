<?php

use Illuminate\Database\Seeder;

class SystemCompanyControlDateSeeder extends Seeder
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
        $this->databaseConnection()->table('system_control_date')->insert([
            'control_code' => 'YEAR2021',
            'control_date_from' => '2021-01-01',
            'control_date_to' => '2021-12-31',
        ]);
    }
}
