<?php

use Illuminate\Database\Seeder;

class UsersTableAddressSeeder extends Seeder
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
        $users_table_address = array(
            array(
                "address_id" => 1,
                "address_company_id" => 1,
                "address_number" => "B362 L48 Baksuit Syuioo",
                "address_city" => "Makati CIty",
                "address_province" => NULL,
                "address_zip_code" => "2231",
                "address_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),

            array(
                "address_id" => 2,
                "address_company_id" => 1,
                "address_number" => "83 Building Aadelle",
                "address_city" => "Pasig City",
                "address_province" => NULL,
                "address_zip_code" => "3421",
                "address_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),

            array(
                "address_id" => 3,
                "address_company_id" => 1,
                "address_number" => "Blk 88 Lot 3 Amm St Brgy. Rizal",
                "address_city" => "Quezon City",
                "address_province" => NULL,
                "address_zip_code" => "2314",
                "address_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),

            array(
                "address_id" => 4,
                "address_company_id" => 2,
                "address_number" => "Ashiond 87 Abahanm ",
                "address_city" => "Baguio City",
                "address_province" => NULL,
                "address_zip_code" => "2312",
                "address_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),

            array(
                "address_id" => 5,
                "address_company_id" => 2,
                "address_number" => "Mossafi 284 Alokka St",
                "address_city" => "Navotas City",
                "address_province" => NULL,
                "address_zip_code" => "4334",
                "address_status" => "active",

                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2021-11-07 21:43:29",
            ),
        );

        $this->databaseConnection()->table('users_tbl_address')->insert($users_table_address);
    }
}
