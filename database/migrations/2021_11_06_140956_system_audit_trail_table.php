<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemAuditTrailTable extends Migration
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
             ->create('system_audit_trail', function (Blueprint $table) {

                $table->unsignedInteger('company_id')->autoIncrement();
                $table->integer('users_id');
                $table->integer('module_id');
                $table->integer('window_id');
                $table->integer('control_id');
                $table->string('ip_address', 20);
                $table->string('remarks', 100);
                $table->dateTime('audit_date');
                
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schemaConnection()->dropIfExists('system_audit_log');
    }
}
