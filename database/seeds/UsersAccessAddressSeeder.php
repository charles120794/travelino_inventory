<?php

use Illuminate\Database\Seeder;

class UsersAccessAddressSeeder extends Seeder
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
        $users_address = array(
            array(
                "access_users_id" => 1,
                "access_address_id" => 1,
                "access_address_default" => 1,

                "status" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),

            array(
                "access_users_id" => 2,
                "access_address_id" => 4,
                "access_address_default" => 1,

                "status" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),
        );

        $this->databaseConnection()->table('users_access_address')->insert($users_address);
    }
}
