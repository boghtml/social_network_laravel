<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedPostsTable extends Migration
{
    public function up()
    {
        Schema::create('saved_posts', function (Blueprint $table) {
            $table->id('savedpost_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamp('datetime_added')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saved_posts');
    }
}
;
