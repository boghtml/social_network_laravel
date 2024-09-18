<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id('story_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->timestamp('datetime_added')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
;
