<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Feature Test:
 *  Evaluan funcionalidades completas del sistema, integrando varias capas de la aplicacion.
 */
class PlayerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: GET /players returns status 200.
     */
    public function test_index_player_controller_get_players_return_status_200(): void
    {
        $ver = env('APP_VER');

        $response = $this->get("/{$ver}/players");
        $response->assertStatus(200);
    }

    /**
     * Test: GET /players returns all players.
     */
    public function test_index_player_controller_returns_all_players(): void
    {
        $ver = env('APP_VER');
        $players = Player::factory()->count(13)->create();

        $response = $this->get("/{$ver}/players");
        $response->assertStatus(200)
                 ->assertJsonCount($players->count());
    }

    /**
     * Test: GET /players/{id} returns player by ID.
     */
    public function test_show_player_controller_get_player_by_id(): void
    {
        $ver = env('APP_VER');
        $player = Player::factory()->create();

        $response = $this->get("/{$ver}/players/{$player->id}");
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $player->id,
                     'first_name' => $player->first_name,
                     'last_name' => $player->last_name,
                 ]);
    }

    /**
     * Test: POST /players returns status 422 when data is invalid.
     */
    public function test_store_player_controller_invalid_data_returns_status_422(): void
    {
        $ver = env('APP_VER');
        $invalidPlayer = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => '1990-01-01',
        ];

        $response = $this->postJson("/{$ver}/players", $invalidPlayer);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['gender']);
    }

    /**
     * Test: POST /players creates a new player.
     */
    public function test_store_player_controller_create_new_player(): void
    {
        $ver = env('APP_VER');
        $player = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 'male',
            'birth_date' => '1990-01-01',
        ];

        $response = $this->postJson("/{$ver}/players", $player);
        $response->assertStatus(201)
                 ->assertJsonFragment($player);

        $this->assertDatabaseCount('players', 1);
    }
}
