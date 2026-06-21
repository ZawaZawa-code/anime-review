<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnimeReview;
use App\Models\EpisodeReview;

class ReviewController extends Controller
{
    // アニメ全体のレビュー投稿
    public function storeAnimeReview(Request $request)
    {
        AnimeReview::create([
            'anime_id' => $request->anime_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'score' => $request->score,
        ]);
        return redirect('/2026-winter');
    }

    // アニメ全体のレビュー更新
    public function updateAnimeReview(Request $request, $id)
    {
        $review = AnimeReview::findOrFail($id);
        $review->review = $request->review;
        $review->score = $request->score;
        $review->save();
        return redirect('/2026-winter');
    }

    // 話数ごとのレビュー投稿
    public function storeEpisodeReview(Request $request)
    {
        EpisodeReview::create([
            'episode_info_id' => $request->episode_info_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'score' => $request->score,
        ]);
        return redirect('/2026-winter');
    }

    // 話数ごとのレビュー更新
    public function updateEpisodeReview(Request $request, $id)
    {
        $review = EpisodeReview::findOrFail($id);
        $review->review = $request->review;
        $review->score = $request->score;
        $review->save();
        return redirect('/2026-winter');
    }
}
