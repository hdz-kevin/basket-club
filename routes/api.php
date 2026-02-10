<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware(ApiForceAcceptHeader::class)->group(function () {
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::get('/players/first_name/{firstName}', [PlayerController::class, 'getByFirstName']);
    Route::post('/players', [PlayerController::class, 'store']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);

    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
});
