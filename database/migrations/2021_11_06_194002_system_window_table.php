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
        return Schema::connection('mysql_test');
    }

    public function up()
    {
        $this->schemaConnection()
             ->create('system_window', function (Blueprint $table) {

                $table->unsignedInteger('menu_id')->autoIncrement();
                $table->unsignedInteger('module_id');
                $table->unsignedInteger('menu_parent');
                $table->unsignedInteger('menu_name');

                $table->integer('menu_level');

                $table->string('menu_path', 200);
                $table->string('menu_icon', 50);
                $table->string('menu_trait', 50);
                $table->string('menu_blade', 50);
                $table->string('menu_method', 50);

                /** 
                 * If true, menu has a sb menu,
                 * else false menu must clickable
                 * 
                */
                $table->boolean('menu_type');
                $table->boolean('menu_status')->default(1);
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
