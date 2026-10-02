<?php

use App\Models\Tournament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentRegistrationController;

// Rute untuk halaman utama
Route::get('/', function () {
    // Mengambil turnamen yang sedang buka pendaftaran atau sedang berlangsung
    $tournaments = Tournament::whereIn('status', ['registration', 'ongoing'])->get();
    return view('welcome', compact('tournaments'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tournament/{id}/register', [TournamentRegistrationController::class, 'showForm'])->name('tournament.register');
    Route::post('/tournament/{id}/register', [TournamentRegistrationController::class, 'register'])->name('tournament.store');
});

// Rute untuk Halaman Detail Turnamen
Route::get('/tournament/{id}', function ($id) {
    // Mencari turnamen berdasarkan ID, jika tidak ada akan memunculkan error 404
    $tournament = App\Models\Tournament::findOrFail($id);
    
    return view('tournament-detail', compact('tournament'));
})->name('tournament.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
