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
        Schema::create('episode_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->integer('episode');
            $table->string('subtitle');
            $table->text('synopsis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episode_infos');
    }
};
