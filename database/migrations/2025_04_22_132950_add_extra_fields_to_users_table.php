<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('num_employees')->nullable();
            $table->string('annual_revenue')->nullable();
            $table->string('industry')->nullable();
            $table->string('custom_industry')->nullable();
            $table->string('current_inventory_system')->nullable();
            $table->string('current_inventory_system_other')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
