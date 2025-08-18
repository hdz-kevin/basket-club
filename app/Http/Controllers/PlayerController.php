<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Carbon\Carbon;
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

    /**
     * Store a new player.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'required|date|before_or_equal:'.Carbon::now()->subYears(6),
        ]);

        $player = Player::create($validated);

        return response()->json(
            [
                'message' => 'Player successfully created',
                'player' => $player,
            ],
            201,
        );
    }
}
