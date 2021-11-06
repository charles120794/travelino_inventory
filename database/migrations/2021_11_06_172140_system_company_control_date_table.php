<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemCompanyControlDateTable extends Migration
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
             ->create('system_control_date', function (Blueprint $table) {

                $table->unsignedInteger('control_id')->autoIncrement();

                $table->string('control_code');
                $table->dateTime('control_date_from');
                $table->dateTime('control_date_to');

                $table->string('status')->default(1);;
                $table->string('order_level')->default(1);;

                $table->integer('updated_by')->nullable();
                $table->dateTime('updated_date')->nullable();

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
