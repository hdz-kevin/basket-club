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
    public function show(string $id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => "Player with id $id not found"], 404);
        }

        return response()->json($player, 200);
    }

    /**
     * Get players by first name.
     *
     * @param string $first_name
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByFirstName(string $first_name)
    {
        $players = Player::where('first_name', $first_name)->get();

        if ($players->isEmpty()) {
            return response()->json(
                [
                    'message' => "No players found with first name $first_name"
                ],
                404,
            );
        }

        return response()->json($players, 200);
    }
}
