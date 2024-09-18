<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashtagMappingsTable extends Migration
{
    public function up()
    {
        Schema::create('hashtag_mappings', function (Blueprint $table) {
            $table->id('hashtagmap_id');
            $table->foreignId('hashtag_id')->constrained('hashtags')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamp('datetime_added')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hashtag_mappings');
    }
}

;
