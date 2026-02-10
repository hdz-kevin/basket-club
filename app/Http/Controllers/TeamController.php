<?php

namespace App\Http\Controllers;

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
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team, HttpResponse::HTTP_OK);
    }
}
