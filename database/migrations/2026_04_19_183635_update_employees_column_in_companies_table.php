<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeesColumnInCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('employees')->change(); // Change to string type
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('employees')->change(); // Revert back if needed
        });
    }
}