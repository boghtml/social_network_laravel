<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('email');
            $table->string('last_name')->nullable()->after('first_name');
            $table->text('address')->nullable()->after('last_name');
            $table->string('role', 20)->default('user')->after('address');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'address', 'role']);
        });
    }
}
