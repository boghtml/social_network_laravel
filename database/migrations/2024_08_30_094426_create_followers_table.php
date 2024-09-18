<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id('follower_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('following_user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('datetime_added')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
;
