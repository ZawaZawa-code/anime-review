<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpisodeReview extends Model
{
    protected $fillable = [
        'episode_info_id',
        'user_id',
        'review',
        'score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function episodeInfo()
    {
        return $this->belongsTo(EpisodeInfo::class);
    }
}
