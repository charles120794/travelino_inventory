<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemFileSystemTable extends Migration
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
             ->create('system_file_system', function (Blueprint $table) {

                $table->unsignedInteger('file_id')->autoIncrement();

                $table->string('file_type', 10);
                $table->string('file_name', 200);
                $table->string('file_path', 200);
                $table->string('file_extension', 15);

                $table->string('status')->default(1);
                $table->unsignedInteger('order_level')->default(1);
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
