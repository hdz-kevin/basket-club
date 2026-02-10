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
        $team = Team::find($id);

        if (! $team) {
            return response()
                ->json(['message' => 'Team not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($team, HttpResponse::HTTP_OK);
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
    public function update(Request $request, int $id)
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
}
