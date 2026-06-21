<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'title',
        'season',
        'synopsis',
    ];

    public function episodeInfos()
    {
        return $this->hasMany(EpisodeInfo::class);
    }
}
