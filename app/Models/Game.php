<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi Many-to-Many ke Platform
    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    // Relasi Many-to-Many ke Genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
