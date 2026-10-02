<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['tournament_id', 'team_a_id', 'team_b_id', 'score_a', 'score_b', 'round'];

    // Relasi ke tabel lain
    public function tournament() { return $this->belongsTo(Tournament::class); }
    public function teamA() { return $this->belongsTo(Team::class, 'team_a_id'); }
    public function teamB() { return $this->belongsTo(Team::class, 'team_b_id'); }
}
