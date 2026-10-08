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
        Schema::create('articles', function (Blueprint $table) {
        $table->id();
        // Ubah relasi menjadi game_title_id
        $table->foreignId('game_title_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->string('slug')->unique();
        $table->enum('category', ['patch_notes', 'tutorial', 'news']);
        $table->longText('content');
        $table->string('thumbnail')->nullable();
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
