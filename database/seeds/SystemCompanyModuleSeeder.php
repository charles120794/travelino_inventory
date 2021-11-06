<?php

use Illuminate\Database\Seeder;

class SystemCompanyModuleSeeder extends Seeder
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
        $system_company_module = array(
            array(
                "company_id" => 1,
                "module_id" => 1,
                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2020-07-28",
            ),
            array(
                "company_id" => 1,
                "module_id" => 2,
                "status" => 1,
                "order_level" => 2,
                "created_by" => 1,
                "created_date" => "2020-07-28",
            ),
            array(
                "company_id" => 1,
                "module_id" => 3,
                "status" => 1,
                "order_level" => 3,
                "created_by" => 1,
                "created_date" => "2020-07-28",
            ),

            array(
                "company_id" => 2,
                "module_id" => 1,
                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-10-24",
            ),
            array(
                "company_id" => 2,
                "module_id" => 2,
                "status" => 1,
                "order_level" => 2,
                "created_by" => 1,
                "created_date" => "2021-10-24",
            ),
            array(
                "company_id" => 2,
                "module_id" => 3,
                "status" => 1,
                "order_level" => 3,
                "created_by" => 1,
                "created_date" => "2021-10-24",
            ),
        );

        $this->databaseConnection()->table('system_company_module')->insert($system_company_module);
    }
}
