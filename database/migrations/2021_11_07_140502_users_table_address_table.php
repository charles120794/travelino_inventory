<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableAddressTable extends Migration
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
             ->create('users_tbl_address', function (Blueprint $table) {

                $table->unsignedInteger('address_id')->autoIncrement();
                $table->unsignedInteger('address_company_id');

                $table->string('address_number', 500);
                $table->string('address_city', 20);
                $table->string('address_province', 100);
                $table->string('address_zip_code', 10);
                $table->string('address_status', 10);

                $table->string('status')->default(1);
                $table->string('order_level')->default(1);

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
