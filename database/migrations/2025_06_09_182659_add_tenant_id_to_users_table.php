<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenantIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add tenant_id as nullable unsigned big integer
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');

            // Optional: add foreign key constraint if tenants table exists
            // $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // If you added foreign key uncomment below line
            // $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
}
