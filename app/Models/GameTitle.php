<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameTitle extends Model
{
    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
