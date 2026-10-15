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
       Schema::create('tournaments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('game_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');
        $table->dateTime('start_date');
        $table->dateTime('end_date');
        $table->enum('status', ['pending', 'approved', 'rejected', 'ongoing', 'completed'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
