<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();

        return view('index', compact('animes'));
    }
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        Anime::create([
            'title' => $request->title,
            'review' => $request->review,
            'score' => $request->score,
        ]);

        return redirect('/');
    }
}
