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
            'season' => $request->season,
            'synopsis' => $request->synopsis,
        ]);

        return redirect('/');
    }

    public function winter2026()
    {
        $animes = Anime::all();
        return view('winter2026', compact('animes'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);
        $anime->review = $request->review;
        $anime->save();
        return redirect('/2026-winter');
    }
}
