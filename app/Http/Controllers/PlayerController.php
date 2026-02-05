<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Get all players from database
     */
    public function index(): JsonResponse
    {
        $players = Player::all();

        return response()->json($players, 200);
    }

    /**
     * Get a player by id
     */
    public function show(int $id): JsonResponse
    {
        $player = Player::find($id);

        if (! $player) {
            return response()->json([
                'message' => 'Player not found',
            ], 404);
        }

        return response()->json($player, 200);
    }

    /**
     * Get players by first name
     */
    public function getByFirstName(string $firstName): JsonResponse
    {
        $players = Player::where('first_name', $firstName)->get();

        if ($players->isEmpty()) {
            return response()->json([
                'message' => 'No players found',
            ], 404);
        }

        return response()->json($players, 200);
    }
}
