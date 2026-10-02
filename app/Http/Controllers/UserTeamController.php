<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTeamController extends Controller
{
    // Menampilkan halaman dashboard beserta daftar tim
    public function index()
    {
        $teams = Team::where('user_id', Auth::id())->get();
        return view('dashboard', compact('teams'));
    }

    // Menyimpan tim baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
        ]);

        Team::create([
            'name' => $request->name,
            'user_id' => Auth::id(), // Menjadikan user yang sedang login sebagai kapten
        ]);

        return back()->with('success', 'Tim berhasil dibuat!');
    }
}