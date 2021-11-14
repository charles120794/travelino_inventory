<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAccessWindowTable extends Migration
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
             ->create('users_access_window', function (Blueprint $table) {

                $table->unsignedInteger('access_id')->autoIncrement();
                $table->unsignedInteger('access_users_id'); // Reference to user.users_id
                $table->unsignedInteger('access_module_id');
                $table->unsignedInteger('access_company_id');
                $table->unsignedInteger('access_window_level'); // Boolean
                $table->boolean('access_window_type'); // Boolean

                $table->string('access_window_code', 10);
                $table->string('access_window_code_parent'); // Reference to `access_window_code
                $table->string('access_window_name', 15);

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
