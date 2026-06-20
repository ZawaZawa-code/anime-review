<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeReview extends Model
{
    protected $fillable = [
        'anime_id',
        'user_id',
        'review',
        'score',
    ];
}
