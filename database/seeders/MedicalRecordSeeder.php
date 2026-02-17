<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::all()->each(function (Player $player) {
            MedicalRecord::factory()->create([
                'player_id' => $player->id,
            ]);
        });
    }
}
