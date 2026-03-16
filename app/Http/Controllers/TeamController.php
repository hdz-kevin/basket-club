<?php

namespace App\Http\Controllers;

use App\Enums\TeamCategory;
use App\Enums\TeamGender;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TeamController extends Controller
{
    /**
     * List teams
     */
    public function index(): JsonResponse
    {
        $teams = Team::all();

        return response()->json($teams, HttpResponse::HTTP_OK);
    }

    /**
     * Show a team
     */
    public function show(int $id): JsonResponse
    {
        $team = Team::with('image')->find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team, HttpResponse::HTTP_OK);
    }

    /**
     * List all games for a team
     */
    public function games(int $id): JsonResponse
    {
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team->games, HttpResponse::HTTP_OK);
    }

    /**
     * Store a new team into the database
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|in:'.implode(',', TeamCategory::values()),
            'gender' => 'required|in:'.implode(',', TeamGender::values()),
        ]);

        $team = Team::create($validated);

        return response()->json(
            [
                'message' => 'Team created successfully',
                'team' => $team,
            ],
            HttpResponse::HTTP_CREATED,
        );
    }

    /**
     * Update a team
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|max:255',
            'category' => 'sometimes|required|in:'.implode(',', TeamCategory::values()),
            'gender' => 'sometimes|required|in:'.implode(',', TeamGender::values()),
        ]);

        $team->update($validated);

        return response()->json([
            'message' => 'Team updated successfully',
            'team' => $team,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Delete a team
     */
    public function destroy(int $id): JsonResponse
    {
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        $team->delete();

        return response()
            ->json(['message' => 'Team deleted successfully'], HttpResponse::HTTP_OK);
    }

    /**
     * Get the most recent game for a team
     */
    public function lastGame(int $id): JsonResponse
    {
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team->latestGame, HttpResponse::HTTP_OK);
    }

    /**
     * Get the game with the most points scored by the team
     */
    public function bestGame(int $id): JsonResponse
    {
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team->bestGame, HttpResponse::HTTP_OK);
    }

    /**
     * Get all players for a team
     */
    public function players(int $id): JsonResponse
    {
        /** @var Team */
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team->players, HttpResponse::HTTP_OK);
    }
}
