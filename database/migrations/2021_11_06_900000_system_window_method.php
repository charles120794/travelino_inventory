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
        return Schema::connection('mysql');
    }

    public function up()
    {
        $this->schemaConnection()
             ->create('system_window_method', function (Blueprint $table) {

                $table->unsignedInteger('window_method_id')->autoIncrement();
                $table->unsignedInteger('window_method_module_id');

                $table->string('window_method_code', 10)->unique();
                $table->string('window_method_window_code');
                
                $table->string('window_method_name', 100);
                $table->string('window_method_request', 10);
                $table->string('window_method_blade', 100);
                $table->string('window_method_action', 50);
                $table->string('window_method_traits', 50);
                $table->string('window_method_type', 50)->default('secure');

                $table->string('status')->default(1);
                $table->string('order_level')->default(1);
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
