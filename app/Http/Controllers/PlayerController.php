<?php

namespace App\Http\Controllers;

use App\Enums\PlayerGender;
use App\Models\Player;
use Carbon\Carbon;
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

    /**
     * Store a new player into the database
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender' => 'required|in:'. implode(',', PlayerGender::values()),
            'birthdate' => 'required|date|before_or_equal:' . Carbon::now()->subYears(10),
        ]);

        $player = Player::create($validated);

        return response()->json([
            'message' => 'Player created successfully',
            'player' => $player,
        ], 201);
    }

    /**
     * Update a player
     */
    public function update(Request $request, int $id): mixed
    {
        $player = Player::find($id);

        if (! $player) {
            return response()->json([
                'message' => 'Player not found',
            ], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|required|max:255',
            'last_name' => 'sometimes|required|max:255',
            'gender' => 'sometimes|required|in:'. implode(',', PlayerGender::values()),
            'birthdate' => 'sometimes|required|date|before_or_equal:' . Carbon::now()->subYears(10),
        ]);

        $player->update($validated);

        return response()->json([
            'message' => 'Player updated successfully',
            'player' => $player,
        ], 200);
    }
}
