<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemModuleGroupTable extends Migration
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
             ->create('system_module_group', function (Blueprint $table) {

                $table->unsignedInteger('group_id')->autoIncrement();

                $table->string('group_code', 20);
                $table->string('group_description', 100);

                $table->string('status')->default(1);;
                $table->string('order_level')->default(1);;

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
        //
    }
}
