<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemNotificationTable extends Migration
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
             ->create('system_notification', function (Blueprint $table) {

                $table->unsignedInteger('notification_id')->autoIncrement();
                $table->unsignedInteger('notification_module');

                $table->string('notification_from_name', 100)->nullable();
                /**
                 * System User
                 */
                $table->string('notification_from')->nullable();
                /**
                 * System User
                 */
                $table->string('notification_to');
                $table->string('notification_status')->default('unread');

                $table->string('notification_title');
                $table->longText('notification_content')->nullable();
                $table->string('notification_type')->nullable();

                $table->string('status')->default(1);;
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
