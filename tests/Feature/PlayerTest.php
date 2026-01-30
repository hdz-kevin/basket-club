<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test PlayerController index return status code 200
     */
    public function test_index_PlayerController_getPlayers_ReturnStatus200(): void
    {
        $version = env('APP_VER');
        $response = $this->get("/$version/players");
        $response->assertStatus(200);
    }
}
