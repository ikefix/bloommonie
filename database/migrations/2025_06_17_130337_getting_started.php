<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('phonenumber', 20);
            $table->string('password');
            $table->string('confirmpassword');
            $table->string('companyname');
            $table->integer('employees');
            $table->integer('revenue');
            $table->string('industry');
            $table->string('inventory');
            $table->string('country');
            $table->string('state');
            $table->string('city');
        });
    }      
    
   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('getting_started');
    }
};