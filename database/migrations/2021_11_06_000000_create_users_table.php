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
        return Schema::connection('mysql');
    }

    public function up()
    {
        $this->schemaConnection()->create('users', function (Blueprint $table) {

            $table->unsignedInteger('users_id')->autoIncrement();
      
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            /**
             * superadmin | admin | manager | user
             */
            $table->string('users_type', 20)->default('user');
            /**
             * For Laravel Authentixcation
             * 
             */
            $table->string('username', 50);
            $table->string('password', 100);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();

            $table->string('business_email', 50)->nullable();
            $table->string('business_position', 50)->nullable();
            $table->string('business_contact_phone', 50)->nullable();
            $table->string('business_contact_address', 100)->nullable();

            $table->string('personal_email', 50)->nullable();
            $table->string('personal_position', 50)->nullable();
            $table->string('personal_contact_phone', 50)->nullable();
            $table->string('personal_contact_address', 50)->nullable();

            $table->string('personal_birth_date', 50)->nullable();
            $table->string('personal_profile_path', 50)->default('default/default_image_01.png');

            $table->string('users_status', 50)->default('active');

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
        $this->schemaConnection()->dropIfExists('users');
    }
}
