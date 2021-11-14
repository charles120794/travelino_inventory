<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemMediaTable extends Migration
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
             ->create('system_media', function (Blueprint $table) {

                $table->unsignedInteger('media_id')->autoIncrement();

                $table->string('media_name', 500);
                $table->string('media_alt_name', 500);
                $table->string('media_description', 500);
                $table->string('media_tags', 100);
                $table->string('media_path', 200);

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
