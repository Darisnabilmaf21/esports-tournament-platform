<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
        $table->id();
        // Ubah relasi menjadi game_title_id
        $table->foreignId('game_title_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');
        $table->dateTime('start_date');
        $table->dateTime('end_date')->nullable();
        $table->string('location')->nullable();
        $table->string('banner_image')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
