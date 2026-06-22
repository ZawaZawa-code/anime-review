<x-app-layout>
    <style>
        button {
            border: 1px solid #333;
            padding: 4px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        a button {
            display: inline-block;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $anime->title }}　{{ $anime->season }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/2026-winter">← 一覧へ戻る</a>

            {{-- あらすじ通常表示 --}}
            <div id="anime-show-{{ $anime->id }}">
                <p style="border: 1px solid black; padding: 10px; width: 50%;">{!! nl2br(e($anime->synopsis)) !!}</p>
                <button onclick="startAnimeEdit({{ $anime->id }})">編集</button>
            </div>

            {{-- あらすじ編集フォーム（最初は非表示） --}}
            <div id="anime-edit-{{ $anime->id }}" style="display:none;">
                <form method="POST" action="/anime/{{ $anime->id }}/update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="episode_id" id="hidden-episode-id" value="">
                    <div>
                        <label>タイトル</label><br>
                        <input type="text" name="title" value="{{ $anime->title }}" style="width: 400px;">
                    </div>
                    <div>
                        <label>シーズン</label><br>
                        <input type="text" name="season" value="{{ $anime->season }}" style="width: 400px;">
                    </div>
                    <div>
                        <label>あらすじ</label><br>
                        <textarea name="synopsis" rows="10" style="width: 400px; font-size: 16px;">{{ $anime->synopsis }}</textarea>
                    </div>
                    <button type="submit">完了</button>
                    <button type="button" onclick="cancelAnimeEdit({{ $anime->id }})">キャンセル</button>
                </form>
            </div>

            {{-- 話数ごとの情報 --}}
            @foreach($anime->episodeInfos as $episodeInfo)
                <div id="episode-{{ $anime->id }}-{{ $episodeInfo->id }}">

                    {{-- 話数通常表示 --}}
                    <div id="episode-show-{{ $episodeInfo->id }}">
                        <h3>第{{ $episodeInfo->episode }}話　{{ $episodeInfo->subtitle }}</h3>
                        <p>{!! nl2br(e($episodeInfo->synopsis)) !!}</p>
                        <button onclick="startEpisodeEdit({{ $episodeInfo->id }})">編集</button>
                    </div>

                    {{-- 話数編集フォーム（最初は非表示） --}}
                    <div id="episode-edit-{{ $episodeInfo->id }}" style="display:none;">
                        <form method="POST" action="/episode-info/{{ $episodeInfo->id }}/update">
                            @csrf
                            @method('PUT')
                            <h3>第{{ $episodeInfo->episode }}話</h3>
                            <div>
                                <label>サブタイトル</label><br>
                                <input type="text" name="subtitle" value="{{ $episodeInfo->subtitle }}" style="width: 400px;">
                            </div>
                            <div>
                                <label>あらすじ</label><br>
                                <textarea name="synopsis" rows="10" style="width: 400px; font-size: 16px;">{{ $episodeInfo->synopsis }}</textarea>
                            </div>
                            <button type="submit">完了</button>
                            <button type="button" onclick="cancelEpisodeEdit({{ $episodeInfo->id }})">キャンセル</button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <script>
        function startAnimeEdit(id) {
            document.getElementById('anime-show-' + id).style.display = 'none';
            document.getElementById('anime-edit-' + id).style.display = 'block';
            const select = document.getElementById('episode-select-' + id);
            document.getElementById('hidden-episode-id').value = select ? select.value : '';
        }

        function cancelAnimeEdit(id) {
            document.getElementById('anime-edit-' + id).style.display = 'none';
            document.getElementById('anime-show-' + id).style.display = 'block';
        }

        function startEpisodeEdit(id) {
            document.getElementById('episode-show-' + id).style.display = 'none';
            document.getElementById('episode-edit-' + id).style.display = 'block';
        }

        function cancelEpisodeEdit(id) {
            document.getElementById('episode-edit-' + id).style.display = 'none';
            document.getElementById('episode-show-' + id).style.display = 'block';
        }
    </script>
</x-app-layout>
