<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;

// アニメ情報
Route::get('/', [AnimeController::class, 'index']);
Route::get('/anime/create', [AnimeController::class, 'create']);
Route::post('/anime/store', [AnimeController::class, 'store']);
Route::get('/anime/{id}/edit', [AnimeController::class, 'edit']);
Route::put('/anime/{id}/update', [AnimeController::class, 'update']);
Route::put('/episode-info/{id}/update', [AnimeController::class, 'updateEpisodeInfo']);
Route::get('/anime/{id}', [AnimeController::class, 'show']);
Route::get('/2026-winter', [AnimeController::class, 'winter2026']);

// レビュー
Route::post('/anime/{id}/review', [ReviewController::class, 'storeAnimeReview']);
Route::put('/anime/review/{id}/update', [ReviewController::class, 'updateAnimeReview']);
Route::post('/episode/{id}/review', [ReviewController::class, 'storeEpisodeReview']);
Route::put('/episode/review/{id}/update', [ReviewController::class, 'updateEpisodeReview']);
