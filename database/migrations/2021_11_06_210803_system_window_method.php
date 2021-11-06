<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemWindowMethod extends Migration
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
             ->create('system_window_method', function (Blueprint $table) {

                $table->unsignedInteger('method_id')->autoIncrement();
                $table->unsignedInteger('menu_id');
                $table->unsignedInteger('module_id');

                $table->string('method_name', 100);
                $table->string('method_request', 10);
                $table->string('method_blade', 50);
                $table->string('method_function', 50);
                $table->string('method_traits', 50);
                $table->string('method_type', 50)->default('secure');

                $table->string('status')->default(1);
                $table->string('order_level')->default(1);
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
        //
    }
}
