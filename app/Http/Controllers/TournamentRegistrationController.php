<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentRegistrationController extends Controller
{
    // Menampilkan halaman form pendaftaran
    public function showForm($id)
    {
        $tournament = Tournament::findOrFail($id);
        
        // Mengambil daftar tim yang dimiliki/dikapteni oleh user yang sedang login
        $userTeams = Team::where('user_id', Auth::id())->get();

        return view('tournament-register', compact('tournament', 'userTeams'));
    }

    // Memproses data pendaftaran
    public function register(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $tournament = Tournament::findOrFail($id);
        
        // Validasi: Cek apakah slot turnamen sudah penuh
        if ($tournament->teams()->count() >= $tournament->max_teams) {
            return back()->with('error', 'Maaf, slot turnamen sudah penuh.');
        }

        // Menyimpan data pendaftaran ke pivot table (team_tournament)
        // syncWithoutDetaching mencegah error jika tim mendaftar 2 kali di turnamen yang sama
        $tournament->teams()->syncWithoutDetaching([$request->team_id]);

        return redirect()->route('tournament.show', $id)
            ->with('success', 'Tim Anda berhasil didaftarkan ke turnamen!');
    }
}