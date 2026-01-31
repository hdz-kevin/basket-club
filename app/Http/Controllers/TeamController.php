<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Get all teams from database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $teams = Team::all();

        return response()->json($teams, 200);
    }
}
