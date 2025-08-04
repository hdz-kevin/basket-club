<?php

namespace Tests\Feature;

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
     * Test: enpoind /players
     */
    public function test_index_PlayerController_getPlayers_ReturnStatus200(): void
    {
        $ver = env('APP_VER');
        $response = $this->get("/{$ver}/players");

        $response->assertStatus(200);
    }

    /**
     * Test route that does not exist.
     */
    public function test_non_existing_route_returns_404(): void
    {
        $this->get('/random/route')->assertStatus(404);
    }
}
