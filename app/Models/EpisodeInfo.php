<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpisodeInfo extends Model
{
    protected $fillable = [
        'anime_id',
        'episode',
        'subtitle',
        'synopsis',
    ];

    public function episodeReviews()
    {
        return $this->hasMany(EpisodeReview::class);
    }
}
