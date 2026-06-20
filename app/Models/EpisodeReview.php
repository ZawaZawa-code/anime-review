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
}
