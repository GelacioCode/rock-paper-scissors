<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::post('/play', [GameController::class, 'play']);
Route::get('/results', [GameController::class, 'results']);
