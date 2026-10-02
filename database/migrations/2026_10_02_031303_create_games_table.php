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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            // Relasi ke turnamen
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade');
            // Relasi ke tim (bisa null jika menunggu pemenang dari match sebelumnya)
            $table->foreignId('team_a_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->foreignId('team_b_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->string('round'); // Contoh: 'Quarter Final', 'Semi Final'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
