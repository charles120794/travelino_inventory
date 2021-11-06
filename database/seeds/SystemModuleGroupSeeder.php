<?php

use Illuminate\Database\Seeder;

class SystemModuleGroupSeeder extends Seeder
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
        $system_module_group = array(
            array(
                "group_id" => 1,
                "group_code" => "INV0001",
                "group_description" => "INVENTORY SYSTEM",
                "status" => 1,
                "order_level" => 1,
                "created_by" => 1,
                "created_date" => "2020-03-08 19:00:22",
            ),
        );

        $this->databaseConnection()->table('system_module_group')->insert($system_module_group);
    }
}
