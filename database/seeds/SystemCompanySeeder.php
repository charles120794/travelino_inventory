<?php

use Illuminate\Database\Seeder;

class SystemCompanySeeder extends Seeder
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
        $this->databaseConnection()->table('system_company')->insert([
            [
                'company_id' => 1,
                'company_code' => '00001',
                'company_name' => 'PROBUILDER',
                'company_plan' => 1,
                'company_description' => 'PROBUILDER WEB SERVICES',
                'company_tagline' => 'WEB SERVICE PROVIDER',
                'company_address' => 'MAKATI CITY',
                'company_email' => 'wongcharlesdave@gmail.com',
                'company_registered_owner' => 'CHARLES DAVE WONG',
                'company_max_users' => 5,
                'company_max_module' => 5,
                'company_status' => 'active',
                'contact_person' => 'CHARLES DAVE WONG',
                'contact_person_phone' => '09616070233',
                'contact_person_email' => 'wongcharlesdave@gmail.com',
                'contact_person_position' => 'WEB DEVELOPER',
                'contact_person_address' => 'MAKATI CITY',
                'company_tin_number' => '123-456-789-00000',
            ],
            [
                'company_id' => 2,
                'company_code' => '00002',
                'company_name' => 'FINMATEK',
                'company_plan' => 1,
                'company_description' => 'FINANCIAL MANAGEMENT TECHNOLOGY',
                'company_tagline' => 'FINMATEK ONLINE VERSION',
                'company_address' => 'PASIG CITY',
                'company_email' => 'finmatek@gmail.com',
                'company_registered_owner' => 'TERESA BUENAOBRA',
                'company_max_users' => 5,
                'company_max_module' => 5,
                'company_status' => 'active',
                'contact_person' => 'TERESA BUENAOBRA',
                'contact_person_phone' => '09619847774',
                'contact_person_email' => 'finmatek@gmail.com',
                'contact_person_position' => 'ACCONTING MANAGER',
                'contact_person_address' => 'PASIG CITY',
                'company_tin_number' => '123-456-789-00000',
            ],
        ]);
    }
}
