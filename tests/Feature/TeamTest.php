<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test TeamController index return status code 200
     */
    public function test_index_TeamController_return_status_200(): void
    {
        $version = env('APP_VER');
        $response = $this->get("/$version/teams");

        $response->assertStatus(200);
    }

    /**
     * Test TeamController index return all teams in json format
     */
    public function test_index_TeamController_return_all_teams(): void
    {
        $teams = Team::factory()->count(10)->create();

        $version = env('APP_VER');
        $response = $this->get("/$version/teams");

        $response->assertJson($teams->toArray());
    }
}
