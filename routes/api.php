<?php

use App\Http\Controllers\PlayerController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/players', [PlayerController::class, 'index'])->middleware([ApiForceAcceptHeader::class]);
