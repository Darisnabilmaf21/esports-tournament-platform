<?php

use App\Models\Tournament;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama
Route::get('/', function () {
    // Mengambil turnamen yang sedang buka pendaftaran atau sedang berlangsung
    $tournaments = Tournament::whereIn('status', ['registration', 'ongoing'])->get();
    return view('welcome', compact('tournaments'));
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
