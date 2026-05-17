<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/', [AnimeController::class, 'index']);
Route::get('/anime/create', [AnimeController::class, 'create']);
Route::post('/anime/store', [AnimeController::class, 'store']);
