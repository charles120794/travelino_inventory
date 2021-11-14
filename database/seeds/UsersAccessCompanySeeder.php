<?php

use Illuminate\Database\Seeder;

class UsersAccessCompanySeeder extends Seeder
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
        $this->databaseConnection()->table('users_access_company')->insert(
            array(
                array(
                    "access_users_id" => 1,
                    "access_company_id" => 1,
                    "access_company_default" => 1,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2020-01-29 00:00:00",
                ),
                array(
                    "access_users_id" => 1,
                    "access_company_id" => 2,
                    "access_company_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-24 00:00:00",
                ),
                array(
                    "access_users_id" => 2,
                    "access_company_id" => 1,
                    "access_company_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-24 00:00:00",
                ),
                array(
                    "access_users_id" => 2,
                    "access_company_id" => 2,
                    "access_company_default" => 1,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-26 00:00:00",
                ),
            )
        );
    }
}
