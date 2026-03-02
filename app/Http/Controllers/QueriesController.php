<?php

namespace App\Http\Controllers;

use App\Models\Team;
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
}
