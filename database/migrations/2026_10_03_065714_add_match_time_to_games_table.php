<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('games', function (Blueprint $table) {
        // Menambahkan kolom waktu, posisinya setelah kolom round. Boleh kosong (nullable) jika jadwal belum ditentukan.
        $table->dateTime('match_time')->nullable()->after('round');
    });
}

public function down(): void
{
    Schema::table('games', function (Blueprint $table) {
        $table->dropColumn('match_time');
    });
}
};
