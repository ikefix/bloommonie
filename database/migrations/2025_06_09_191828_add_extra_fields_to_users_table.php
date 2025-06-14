<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_phone',
                'company_name',
                'num_employees',
                'annual_revenue',
                'industry',
                'custom_industry',
                'current_inventory_system',
                'current_inventory_system_other',
                'country',
                'state',
                'city',
            ]);
        });
    }
};
