<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashtagsTable extends Migration
{
    public function up()
    {
        Schema::create('hashtags', function (Blueprint $table) {
            $table->id();  // Змініть це з $table->id('hashtag_id') на $table->id()
            $table->string('hashtag')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hashtags');
    }
}


;
