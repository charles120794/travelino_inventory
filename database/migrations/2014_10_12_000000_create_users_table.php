<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
        $this->schemaConnection()->create('users', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->autoIncrement();
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('users_window_access');
            $table->unsignedInteger('users_address');

            $table->string('users_type', 20);
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            $table->string('lastname', 50);
            $table->string('email', 50)->unique();
            $table->string('name', 50);
            $table->string('education', 50);
            $table->string('password', 50);
            $table->string('username', 50);
            $table->string('business_email', 50);
            $table->string('position_title', 50);
            $table->string('business_contact_phone', 50);
            $table->string('business_position', 50);
            $table->string('personal_email', 50);
            $table->string('personal_contact_phone', 50);
            $table->string('personal_tin', 50);
            $table->string('personal_phillhealth', 50);
            $table->string('personal_license_number', 50);
            $table->string('personal_address', 50);
            $table->string('birth_date', 50);
            $table->string('profile_path', 50);
            $table->string('users_status', 50)->default('active');

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();

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
        $this->schemaConnection()->dropIfExists('users');
    }
}
