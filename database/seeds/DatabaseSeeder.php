<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            /* Trncate First the database */
            SystemDatabaseTruncate::class,

            SystemCompanySeeder::class,
            SystemCompanyControlDateSeeder::class,
            SystemModuleGroupSeeder::class,
            SystemModuleSeeder::class,
            SystemCompanyModuleSeeder::class,
            SystemWindowSeeder::class,
            SystemCompanyWindowMethodSeeder::class,
            SystemAuditTrailSeeder::class,
        ]);
    }
}
