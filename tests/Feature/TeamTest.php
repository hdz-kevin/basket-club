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

    protected string $version;

    public function setUp(): void
    {
        parent::setUp();
        $this->version = env('APP_VER');
    }

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
     * Test TeamController index return all teams
     */
    public function test_index_TeamController_return_all_teams(): void
    {
        $teams = Team::factory()->count(10)->create();

        $version = env('APP_VER');
        $response = $this->get("/$version/teams");

        $response->assertJson($teams->toArray());
    }

    /**
     * Test TeamController show return team by id
     */
    public function test_show_TeamController_return_team_by_id(): void
    {
        $teams = Team::factory()->count(5)->create();
        $team = $teams->random();

        $this->get("{$this->version}/teams/{$team->id}")
             ->assertStatus(200)
             ->assertJson($team->toArray());
    }

    /**
     * Test TeamController store return status code 422 if data is invalid
     */
    public function test_store_TeamController_return_status_422_if_data_is_invalid(): void
    {
        $team = [
            'name' => "test",
        ];

        $this->postJson("{$this->version}/teams", $team)
             ->assertStatus(422);
    }

    /**
     * Test TeamController store save team and returns it
     */
    public function test_store_TeamController_save_team(): void
    {
        $team = [
            'name' => 'Test Team',
            'category' => TeamCategory::BENJAMINES->value,
            'gender' => TeamGender::MIX->value,
        ];

        $this->postJson("{$this->version}/teams", $team)
             ->assertStatus(201)
             ->assertJsonFragment($team);
    }

    /**
     * Test TeamController update team and returns it
     */
    public function test_update_TeamController_update_team(): void
    {
        $team = Team::factory()->create();
        $updatedTeam = [
            'name' => 'Updated Team',
            'category' => TeamCategory::ALEVINES->value,
        ];

        $this->putJson("{$this->version}/teams/{$team->id}", $updatedTeam)
             ->assertStatus(200)
             ->assertJsonFragment($updatedTeam);
    }

    /**
     * Test TeamController destroy delete team
     */
    public function test_destroy_TeamController_delete_team(): void
    {
        $team = Team::factory()->create();

        $this->delete("{$this->version}/teams/{$team->id}")
             ->assertStatus(200);
        $this->assertDatabaseCount('teams', 0);
    }
}
