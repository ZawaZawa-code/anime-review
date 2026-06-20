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
        Schema::create('anime_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('episode_info_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('role');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anime_staffs');
    }
};
