<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemAlterAccessTable extends Migration
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
        $this->schemaConnection()->table('users_access_address', function (Blueprint $table) {
            $table->foreign('access_users_id')->references('users_id')->on('users');
            $table->foreign('access_address_id')->references('address_id')->on('users_tbl_address');
        });

        $this->schemaConnection()->table('users_access_company', function (Blueprint $table) {
            $table->foreign('access_users_id')->references('users_id')->on('users');
            $table->foreign('access_company_id')->references('company_id')->on('system_company');
        });

        $this->schemaConnection()->table('users_access_module', function (Blueprint $table) {
            $table->foreign('access_users_id')->references('users_id')->on('users');
            $table->foreign('access_module_id')->references('module_id')->on('system_module');
            $table->foreign('access_company_id')->references('company_id')->on('system_company');
        });

        $this->schemaConnection()->table('users_access_window', function (Blueprint $table) {
            
            $table->foreign('access_users_id')->references('users_id')->on('users');
            $table->foreign('access_module_id')->references('module_id')->on('system_module');
            $table->foreign('access_company_id')->references('company_id')->on('system_company');

            $table->foreign('access_window_code')->references('window_code')->on('system_window');
        });

        $this->schemaConnection()->table('users_access_window_method', function (Blueprint $table) {

            $table->foreign('access_users_id')->references('users_id')->on('users');
            $table->foreign('access_module_id')->references('module_id')->on('system_module');
            $table->foreign('access_company_id')->references('company_id')->on('system_company');

            $table->foreign('access_window_method_code')->references('window_method_code')->on('system_window_method');
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
