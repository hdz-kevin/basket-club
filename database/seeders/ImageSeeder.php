<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an image for each player
        Player::all()->each(function (Player $player) {
            $player->image()->create(
                Image::factory()->make()->toArray()
            );
        });

        // Create an image for each team
        Team::all()->each(function (Team $team) {
            $team->image()->create(
                Image::factory()->make()->toArray()
            );
        });
    }
}
