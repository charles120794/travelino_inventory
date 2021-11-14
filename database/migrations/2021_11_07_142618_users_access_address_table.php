<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAccessAddressTable extends Migration
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
             ->create('users_access_address', function (Blueprint $table) {

                $table->unsignedInteger('access_id')->autoIncrement();
                $table->unsignedInteger('access_users_id');
                $table->unsignedInteger('access_address_id');

                $table->boolean('access_address_default')->default(0);

                $table->string('status')->default(1);
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
