<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        for ($i = 0; $i < 20; $i++) {
            Game::factory()->create([
                'team_id' => $teams->random()->id,
            ]);
        }
    }
}
