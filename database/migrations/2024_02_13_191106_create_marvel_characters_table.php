<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarvelCharactersTable extends Migration
{
    public function up()
    {
        Schema::create('marvel_characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('resource_uri')->nullable();
            $table->string('comics_available')->nullable();
            $table->string('series_available')->nullable();
            $table->string('stories_available')->nullable();
            $table->string('events_available')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marvel_characters');
    }
}
