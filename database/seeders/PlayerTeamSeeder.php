<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();
        $players = Player::all();

        foreach ($teams as $team) {
            $team->players()->attach(
                $players->random(10)->pluck('id')->toArray()
            );
        }
    }
}
