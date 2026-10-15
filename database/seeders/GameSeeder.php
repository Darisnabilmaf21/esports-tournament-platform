<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Genre;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Platform
        $mobile = Platform::create(['name' => 'Mobile', 'slug' => 'mobile']);
        $pc = Platform::create(['name' => 'PC', 'slug' => 'pc']);

        // 2. Buat Genre
        $moba = Genre::create(['name' => 'MOBA', 'slug' => 'moba']);
        $fps = Genre::create(['name' => 'FPS', 'slug' => 'fps']);
        $battleRoyale = Genre::create(['name' => 'Battle Royale', 'slug' => 'battle-royale']);

        // 3. Buat Data Game dan Hubungkan ke Platform & Genre
        $mlbb = Game::create([
            'title' => 'Mobile Legends: Bang Bang',
            'slug' => 'mobile-legends-bang-bang',
            'developer' => 'Moonton',
            'description' => 'Game MOBA 5v5 yang sangat populer di Asia Tenggara.',
        ]);
        $mlbb->platforms()->attach($mobile->id);
        $mlbb->genres()->attach($moba->id);

        $valorant = Game::create([
            'title' => 'Valorant',
            'slug' => 'valorant',
            'developer' => 'Riot Games',
            'description' => 'Game tactical shooter 5v5 berbasis karakter.',
        ]);
        $valorant->platforms()->attach($pc->id);
        $valorant->genres()->attach($fps->id);

        $pubgm = Game::create([
            'title' => 'PUBG Mobile',
            'slug' => 'pubg-mobile',
            'developer' => 'Level Infinite',
            'description' => 'Game Battle Royale 100 pemain klasik.',
        ]);
        $pubgm->platforms()->attach($mobile->id);
        $pubgm->genres()->attach($battleRoyale->id);
    }
}
