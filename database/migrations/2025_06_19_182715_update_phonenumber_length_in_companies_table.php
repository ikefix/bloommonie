<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhonenumberLengthInCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('phonenumber', 30)->change(); // or higher, like 50
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('phonenumber', 15)->change(); // assuming 15 was the original
        });
    }
}
