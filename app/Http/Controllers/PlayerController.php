<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Get all players.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Player::all());
    }

    /**
     * Get a specific player by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => "Player with id $id not found"], 404);
        }

        return response()->json($player, 200);
    }
}
