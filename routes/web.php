<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/', [AnimeController::class, 'index']);
Route::get('/anime/create', [AnimeController::class, 'create']);
Route::post('/anime/store', [AnimeController::class, 'store']);
Route::get('/2026-winter', [AnimeController::class, 'winter2026']);
Route::put('/anime/{id}/update', [AnimeController::class, 'update']);
