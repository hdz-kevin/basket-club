<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class GameController extends Controller
{
    /**
     * List games
     */
    public function index()
    {
        $games = Game::all();

        return response()->json($games, HttpResponse::HTTP_OK);
    }

    /**
     * Show game by id
     */
    public function show(int $id)
    {
        $game = Game::find($id);

        if (! $game) {
            return response()
                ->json(['message' => 'Game not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($game, HttpResponse::HTTP_OK);
    }
}
