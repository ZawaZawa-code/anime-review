<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('anime_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('review');
            $table->integer('score');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anime_reviews');
    }
};
