<?php

namespace Tests\Feature;

use App\Enums\TeamCategory;
use App\Enums\TeamGender;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_TeamController_index_ReturnsStatus200(): void
    {
        $ver = env('APP_VER');
        $response = $this->get("/{$ver}/teams");

        $response->assertStatus(200);
    }

    /**
     * Test: TeamController index returns teams data.
     */
    public function test_TeamController_index_ReturnsTeamsData(): void
    {
        $ver = env('APP_VER');

        $teams = [
            [
                'name' => 'Team A',
                'category' => TeamCategory::Senior->value,
                'gender' => TeamGender::Male->value,
            ],
            [
                'name' => 'Team B',
                'category' => TeamCategory::Junior->value,
                'gender' => TeamGender::Female->value,
            ]
        ];

        Team::factory()->createMany($teams);

        $response = $this->get("/{$ver}/teams");

        $response->assertStatus(200)
                ->assertJsonCount(2)
                ->assertJsonStructure([
                    '*' => [
                        'id',
                        'name',
                        'category',
                        'gender',
                        'created_at',
                        'updated_at'
                    ]
                ])
                ->assertJsonFragment($teams[0])
                ->assertJsonFragment($teams[1]);
    }
}
