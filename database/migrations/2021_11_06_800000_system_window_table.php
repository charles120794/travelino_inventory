<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemWindowTable extends Migration
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
             ->create('system_window', function (Blueprint $table) {

                $table->unsignedInteger('window_id')->autoIncrement();
                $table->unsignedInteger('window_module_id');

                $table->integer('window_level');

                $table->string('window_code', 10)->unique();
                $table->string('window_code_parent', 10)->nullable();
                $table->string('window_name', 15);

                $table->string('window_path', 200);
                $table->string('window_trait', 50);
                $table->string('window_method', 50);
                $table->string('window_blade', 50);
                $table->string('window_icon', 50);

                /** 
                 * If true, menu has a sb menu,
                 * else false menu must clickable
                 * 
                */
                $table->boolean('window_type');
                $table->boolean('window_status')->default(1);
                
                $table->integer('order_level')->default(1);
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
