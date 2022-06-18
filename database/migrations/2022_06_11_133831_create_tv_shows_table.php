<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_shows', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('tmdb_id')->unique();
            $table->date('first_air_date')->nullable();
            $table->date('last_air_date')->nullable();
            $table->integer('episode_run_time')->nullable();
            $table->integer('number_of_seasons')->nullable();
            $table->integer('number_of_episodes')->nullable();  
            $table->string('status')->nullable();
            $table->float('vote_average')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_shows');
    }
};
