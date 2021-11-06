<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemModuleTable extends Migration
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
             ->create('system_module', function (Blueprint $table) {

                $table->unsignedInteger('module_id')->autoIncrement();
                $table->unsignedInteger('module_group');

                $table->string('module_code', 20)->unique();
                /**
                 *  Redirect user to default page of dashboard
                 * 
                 */
                $table->string('module_home', 50);
                $table->string('module_name', 50);
                $table->string('module_description', 100);

                $table->longText('module_full_description')->nullable(); // Documentation
                $table->longText('module_change_log')->nullable(); // Documentation

                $table->string('module_prefix', 20);
                $table->string('module_sub_domain', 20)->nullable();
                $table->string('module_class_icon', 20)->nullable();
                $table->string('module_class_design', 20)->nullable();

                /**
                 *  Redirect user when module clicked
                 * 
                 */
                $table->string('module_redirect_route', 100);
                /**
                 *  Module type is either Free or for Sale
                 *  Type: free | sales
                 */
                $table->string('module_type', 100)->default('free');
                $table->string('module_status', 20)->default('active');

                $table->decimal('module_unit_price', 8, 2)->default(0);
                $table->decimal('module_unit_cost', 8, 2)->default(0);
                $table->decimal('module_discount', 8, 2)->default(0);
                $table->decimal('module_vatable', 8, 2)->default(0);
                $table->decimal('module_vat', 8, 2)->default(0);
                $table->decimal('module_exempt', 8, 2)->default(0);
                $table->decimal('module_zero_rated', 8, 2)->default(0);

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
