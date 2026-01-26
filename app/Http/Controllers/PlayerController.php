<?php

namespace App\Http\Controllers;

use App\Models\Player;
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
}
