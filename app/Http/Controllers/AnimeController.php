<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use App\Models\EpisodeInfo;

class AnimeController extends Controller
{
    public function index()
    {
        return view('index');
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

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        return view('anime.edit', compact('anime'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);
        $anime->title = $request->title;
        $anime->season = $request->season;
        $anime->synopsis = $request->synopsis;
        $anime->save();

        $episodeId = $request->episode_id;
        if ($episodeId && $episodeId !== 'all') {
            return redirect('/anime/' . $id . '?episode=' . $episodeId);
        }
        return redirect('/anime/' . $id);
    }

    public function winter2026()
    {
        $animes = Anime::with('episodeInfos')->get();
        return view('winter2026', compact('animes'));
    }

    public function show($id)
    {
        $anime = Anime::with('episodeInfos')->findOrFail($id);
        return view('anime.show', compact('anime'));
    }

    public function updateEpisodeInfo(Request $request, $id)
    {
        $episodeInfo = EpisodeInfo::findOrFail($id);
        $episodeInfo->subtitle = $request->subtitle;
        $episodeInfo->synopsis = $request->synopsis;
        $episodeInfo->save();
        return redirect('/anime/' . $episodeInfo->anime_id . '?episode=' . $episodeInfo->id);
    }

}
