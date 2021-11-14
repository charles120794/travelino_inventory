<?php

use Illuminate\Database\Seeder;

class UsersAccessModuleSeeder extends Seeder
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
        $this->databaseConnection()->table('users_access_module')->insert(
            array(
                /* User 1 */
                array(
                    "access_users_id" => 1,
                    "access_module_id" => 1,
                    "access_company_id" => 1,
                    "access_module_default" => 1,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2020-08-07 22:43:47",
                ),
                array(
                    "access_users_id" => 1,
                    "access_module_id" => 2,
                    "access_company_id" => 1,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2020-08-08 00:55:57",
                ),
                array(
                    "access_users_id" => 1,
                    "access_module_id" => 3,
                    "access_company_id" => 1,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2019-10-26 00:00:00",
                ),
                array(
                    "access_users_id" => 1,
                    "access_module_id" => 4,
                    "access_company_id" => 1,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2020-08-08 00:55:58",
                ),
                array(
                    "access_users_id" => 1,
                    "access_module_id" => 5,
                    "access_company_id" => 1,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2020-08-09 19:48:28",
                ),
                /* User 2 */
                array(
                    "access_users_id" => 2,
                    "access_module_id" => 1,
                    "access_company_id" => 2,
                    "access_module_default" => 1,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2019-12-28 00:00:00",
                ),
                array(
                    "access_users_id" => 2,
                    "access_module_id" => 2,
                    "access_company_id" => 2,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-24 09:46:13",
                ),
                array(
                    "access_users_id" => 2,
                    "access_module_id" => 3,
                    "access_company_id" => 2,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-24 09:54:10",
                ),
                array(
                    "access_users_id" => 2,
                    "access_module_id" => 4,
                    "access_company_id" => 2,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-26 10:56:52",
                ),
                array(
                    "access_users_id" => 2,
                    "access_module_id" => 5,
                    "access_company_id" => 2,
                    "access_module_default" => 0,
                    "access_plan_status" => "active",
                    "status" => 1,
                    "created_by" => 1,
                    "created_date" => "2021-10-26 11:02:46",
                ),
            )
        );
    }
}
