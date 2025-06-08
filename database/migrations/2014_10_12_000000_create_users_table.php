<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            
            // Marketing site fields
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

            // POS software fields
            $table->string('role')->nullable(); // e.g., admin, cashier, manager
            $table->unsignedBigInteger('shop_id')->nullable(); // ← Foreign key removed

            // Laravel auth defaults
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Removed this line:
            // $table->foreign('shop_id')->references('id')->on('shops')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
