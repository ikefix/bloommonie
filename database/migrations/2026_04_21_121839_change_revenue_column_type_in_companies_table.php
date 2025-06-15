<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRevenueColumnTypeInCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('revenue')->change(); // Change from integer to string
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('revenue')->change(); // Revert back to integer if needed
        });
    }
}
