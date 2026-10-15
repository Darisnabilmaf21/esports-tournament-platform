<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\TournamentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute Publik untuk MVP Playora
Route::get('/games', [GameController::class, 'index']);

// Rute Publik (Tidak butuh token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terlindungi (Wajib menyertakan Token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Endpoint Publik untuk Games
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{slug}', [GameController::class, 'show']);

// Endpoint Publik untuk Tournaments
Route::get('/tournaments', [TournamentController::class, 'index']);
Route::get('/tournaments/{slug}', [TournamentController::class, 'show']);
