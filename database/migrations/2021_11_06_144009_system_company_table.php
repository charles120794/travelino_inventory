<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected function schemaConnection()
    {
        return Schema::connection('mysql_test');
    }

    public function up()
    {

        $this->schemaConnection()
             ->create('system_company', function (Blueprint $table) {

                $table->unsignedInteger('company_id')->autoIncrement();

                $table->string('company_code', 10);
                $table->string('company_name', 50);
                $table->string('company_plan', 50);

                $table->longText('company_description')->nullable();
                $table->string('company_logo', 500)->nullable();
                $table->string('company_cover_photo', 500)->nullable();
                $table->string('company_currency_id', 50)->nullable();
                $table->string('company_tagline', 100)->nullable();
                $table->string('company_address', 100)->nullable();
                $table->string('company_email', 50)->nullable();
                $table->string('company_contact_phone', 30)->nullable();
                $table->string('company_contact_number', 30)->nullable();
                $table->string('company_registered_owner', 50)->nullable();
                $table->string('company_tin_number', 14)->nullable();
                $table->string('company_business_style', 100)->nullable();
                $table->string('company_facebook', 100)->nullable();
                $table->string('company_twitter', 100)->nullable();
                $table->string('company_instagram', 100)->nullable();
                $table->string('company_pinterest', 100)->nullable();
                $table->string('company_website', 100)->nullable();
                $table->string('company_status')->default('active');
                $table->string('company_fax_number', 20)->nullable();
                $table->string('company_zip_code', 5)->nullable();
                $table->dateTime('company_foundation')->nullable();
                $table->string('company_license_no', 100)->nullable();
                $table->string('company_agent_type', 100)->nullable();
                $table->string('company_branch_code', 20)->nullable();
                $table->string('company_tax_code', 20)->nullable();
                $table->string('company_backup_method', 20)->default('monthly');

                $table->integer('company_max_users')->default(5);
                $table->integer('company_max_module')->default(5);
                $table->integer('company_main_flag')->default(0);

                $table->string('contact_person', 100)->nullable();
                $table->string('contact_person_phone', 100)->nullable();
                $table->string('contact_person_email', 100)->nullable();
                $table->string('contact_person_position', 100)->nullable();
                $table->string('contact_person_address', 100)->nullable();

                $table->string('status')->default(0);;
                $table->string('order_level')->default(0);;

                $table->integer('updated_by')->nullable();
                $table->dateTime('updated_date')->nullable();

                $table->integer('created_by')->nullable();
                $table->dateTime('created_date')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schemaConnection()->dropIfExists('system_company');
    }
}
