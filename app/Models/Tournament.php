<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

     // Relasi ke model User sebagai penyelenggara
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Relasi ke Game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // Relasi ke Partisipan Turnamen
    public function participants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }

}
