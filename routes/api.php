<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware([ApiForceAcceptHeader::class])->group(function () {
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::get('/players/{id}/medicalrecord', [PlayerController::class, 'showMedicalRecord']);
    Route::get('/players/first_name/{firstName}', [PlayerController::class, 'getByFirstName']);
    Route::post('/players', [PlayerController::class, 'store']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);

    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::get('/teams/{id}/games', [TeamController::class, 'games']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);

    Route::get('/medicalrecords', [MedicalRecordController::class, 'index']);
    Route::get('/medicalrecords/{id}', [MedicalRecordController::class, 'show']);
    Route::get('/medicalrecords/{id}/player', [MedicalRecordController::class, 'showPlayer']);

    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::get('/games/{id}/team', [GameController::class, 'team']);
});
