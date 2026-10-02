<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Relasi ke User (Kapten Tim)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
