<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_title',
        'max_teams',
        'start_date',
        'status',
    ];

    public function teams()
{
    return $this->belongsToMany(Team::class);
}

public function games()
    {
        return $this->hasMany(Game::class);
    }
}

