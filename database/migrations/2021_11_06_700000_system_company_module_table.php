<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemCompanyModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function schemaConnection()
    {
        return Schema::connection('mysql');
    }

    public function up()
    {
        $this->schemaConnection()
             ->create('system_company_module', function (Blueprint $table) {

                $table->unsignedInteger('access_id')->autoIncrement();;
                $table->unsignedInteger('access_company_company_id');
                $table->unsignedInteger('access_company_module_id');

                $table->string('status')->default(0);;
                $table->string('order_level')->default(0);;

                $table->unsignedInteger('updated_by')->nullable();
                $table->dateTime('updated_date')->nullable();

                $table->unsignedInteger('created_by')->nullable();
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
        $this->schemaConnection()->dropIfExists('system_company_module');
    }
}
