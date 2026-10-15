<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Menampilkan daftar semua game
     */
    public function index()
    {
        // Mengambil semua game beserta data relasi platform dan genrenya
        $games = Game::with(['platforms', 'genres'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Game berhasil diambil',
            'data'    => $games
        ], 200);
    }

    /**
     * Menampilkan detail satu game berdasarkan slug
     */
    public function show($slug)
    {
        $game = Game::with(['platforms', 'genres'])->where('slug', $slug)->first();

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Game berhasil diambil',
            'data'    => $game
        ], 200);
    }
}