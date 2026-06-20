<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeStaff extends Model
{
    protected $fillable = [
        'anime_id',
        'episode_info_id',
        'role',
        'name',
    ];
}
