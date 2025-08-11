<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Get all teams.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function index(Request $request)
    {
        $teams = Team::all();

        return response()->json($teams);
    }
}
