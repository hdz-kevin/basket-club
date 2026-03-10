<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class QueriesController extends Controller
{
    /**
     * List teams with their games
     * 
     * @param int|null $id Optional team id. If provided, return only that team and its games.
     * @return JsonResponse
     */
    public function teamsWithGames(?int $id = null)
    {
        if (is_null($id)) {
            $teams = Team::with('games')->get();

            return response()->json($teams, 200);
        }

        /** @var Team */
        $team = Team::find($id);

        if (! $team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        return response()->json($team->load('games'), 200);
    }

    public function userMedicalRecord(int $id)
    {
        $user = User::with('playerMedicalRecord')->find($id);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }
}
