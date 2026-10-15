<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Menampilkan daftar semua turnamen
     */
    public function index()
    {
        // Mengambil semua turnamen beserta relasi game dan penyelenggara (organizer)
        $tournaments = Tournament::with(['game', 'organizer'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Turnamen berhasil diambil',
            'data'    => $tournaments
        ], 200);
    }

    /**
     * Menampilkan detail satu turnamen berdasarkan slug
     */
    public function show($slug)
    {
        $tournament = Tournament::with(['game', 'organizer'])->where('slug', $slug)->first();

        if (!$tournament) {
            return response()->json([
                'success' => false,
                'message' => 'Turnamen tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Turnamen berhasil diambil',
            'data'    => $tournament
        ], 200);
    }
}