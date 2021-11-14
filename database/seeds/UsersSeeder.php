<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
        $users = array(
            array(
                "users_id" => 1,

                "lastname" => "Wong",
                "middlename" => "Banage",
                "firstname" => "Charles Dave",

                "users_type" => "superadmin",

                "username" => "Charles",
                "password" => bcrypt('charleswong'),
                "email" => "wongcharlesdave@gmail.com",
                "email_verified_at" => "2021-10-26 09:41:39",

                "personal_email" => "wongcharlesdave@gmail.com",
                "personal_position" => "Developer",
                "personal_contact_phone" => "09616070233",
                "personal_birth_date" => "2021-10-24",
                "personal_profile_path" => "default/default_image_01.png",
                
                "users_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-10-24 21:43:29",
                "updated_by" => NULL,
                "updated_date" => NULL,
            ),
            array(
                "users_id" => 2,

                "lastname" => "Buenaobra",
                "middlename" => "T",
                "firstname" => "Teresa",

                "users_type" => "admin",

                "username" => "Teresa",
                "password" => bcrypt('123password'),
                "email" => "teresa@gmail.com",
                "email_verified_at" => "2021-10-26 09:41:39",

                "personal_email" => "teresa@gmail.com",
                "personal_position" => "Manager",
                "personal_contact_phone" => "09690000000",
                "personal_birth_date" => "2021-10-24",
                "personal_profile_path" => "default/default_image_01.png",
                
                "users_status" => "active",
                
                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-10-24 21:43:29",
                "updated_by" => NULL,
                "updated_date" => NULL,
            ),
        );

        $this->databaseConnection()->table('users')->insert($users);
    }
}
