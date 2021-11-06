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
        return Schema::connection('mysql_test');
    }

    public function up()
    {
        $this->schemaConnection()->table('system_window_method', function (Blueprint $table) {
            $table->foreign('menu_id')->references('menu_id')->on('system_window');
        });

        $this->schemaConnection()->table('system_window_method', function (Blueprint $table) {
            $table->foreign('module_id')->references('module_id')->on('system_module');
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
