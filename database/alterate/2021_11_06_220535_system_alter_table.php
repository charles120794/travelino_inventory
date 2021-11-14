<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemAlterTable extends Migration
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
        $this->schemaConnection()->table('system_module', function (Blueprint $table) {
            $table->foreign('module_group')->references('group_id')->on('system_module_group');
        });

        $this->schemaConnection()->table('system_company_module', function (Blueprint $table) {
            $table->foreign('access_company_company_id')->references('company_id')->on('system_company');
            $table->foreign('access_company_module_id')->references('module_id')->on('system_module');
        });

        $this->schemaConnection()->table('system_window', function (Blueprint $table) {
            $table->foreign('window_module_id')->references('module_id')->on('system_module');
        });

        $this->schemaConnection()->table('system_window_method', function (Blueprint $table) {
            $table->foreign('window_method_module_id')->references('module_id')->on('system_module');
            $table->foreign('window_method_window_code')->references('window_code')->on('system_window');
        });

        $this->schemaConnection()->table('users_tbl_address', function (Blueprint $table) {
            $table->foreign('address_company_id')->references('company_id')->on('system_company');
        });

        $this->schemaConnection()->table('system_audit_trail', function (Blueprint $table) {
            $table->foreign('company_id')->references('company_id')->on('system_company');
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
