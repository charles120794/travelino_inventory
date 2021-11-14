<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAccessModuleTable extends Migration
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
             ->create('users_access_module', function (Blueprint $table) {

                $table->unsignedInteger('access_id')->autoIncrement();
                $table->unsignedInteger('access_users_id');
                $table->unsignedInteger('access_module_id');
                $table->unsignedInteger('access_company_id');

                $table->boolean('access_module_default')->default(0);
                $table->string('access_plan_status')->default('active');

                $table->string('status')->default(1);
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
        //
    }
}
