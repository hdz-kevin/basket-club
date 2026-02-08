<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    protected string $version;

    public function setUp(): void
    {
        parent::setUp();
        $this->version = env('APP_VER');
    }

    /**
     * Test PlayerController index return status code 200
     */
    public function test_index_PlayerController_return_status_200(): void
    {
        $response = $this->get("/{$this->version}/players");
        $response->assertStatus(200);
    }

    /**
     * Test PlayerController index return all players
     */
    public function test_index_PlayerController_return_all_players(): void
    {
        $players = Player::factory()->count(10)->create();

        $response = $this->get("/{$this->version}/players");
        $response->assertStatus(200)
                 ->assertJson($players->toArray());
    }

    /**
     * Test PlayerController show return player by id
     */
    public function test_show_PlayerController_return_player_by_id(): void
    {
        $player = Player::factory()->create();

        $response = $this->get("/{$this->version}/players/{$player->id}");
        $response->assertStatus(200)
                 ->assertJson($player->toArray());
    }

    /**
     * Test PlayerController store return status code 422 if data is invalid
     */
    public function test_store_PlayerController_return_status_422_if_data_is_invalid(): void
    {
        $player = [
            'first_name' => 'Tommy',
            'last_name' => 'Shelby',
            'birthdate' => '1890-01-01',
        ];

        $response = $this->postJson("/{$this->version}/players", $player);
        $response->assertStatus(422);
    }

    /**
     * Test PlayerController store save player and returns it
     */
    public function test_store_PlayerController_save_player(): void
    {
        $player = [
            'first_name' => 'Josue',
            'last_name' => 'Garcia',
            'gender' => 'male',
            'birthdate' => '2002-10-21',
        ];

        $response = $this->postJson("{$this->version}/players", $player);
        $response->assertStatus(201)
                 ->assertJsonFragment($player);
    }

    /**
     * Test PlayerController update player and returns it
     */
    public function test_update_PlayerController_update_player(): void
    {
        $player = Player::factory()->create();
        $update = [
            'first_name' => 'Maria',
            'last_name' => 'Hernandez',
            'birthdate' => '2000-01-01',
        ];

        $response = $this->putJson("{$this->version}/players/{$player->id}", $update);
        $response->assertStatus(200)
                 ->assertJsonFragment($update);
    }

    /**
     * Test PlayerController destroy delete player
     */
    public function test_destroy_PlayerController_delete_player(): void
    {
        $player = Player::factory()->create();

        $this->delete("{$this->version}/players/{$player->id}")->assertStatus(200);
        $this->get("{$this->version}/players/{$player->id}")->assertStatus(404);
    }
}
