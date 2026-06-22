<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

require __DIR__.'/auth.php';
