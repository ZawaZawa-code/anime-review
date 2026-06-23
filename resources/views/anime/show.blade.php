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
                        <h3>第{{ $episodeInfo->episode }}話　{{ $episodeInfo->subtitle }}　<button onclick="toggleReview({{ $episodeInfo->id }})">💬</button></h3>
                        <p>{!! nl2br(e($episodeInfo->synopsis)) !!}</p>
                        <button onclick="startEpisodeEdit({{ $episodeInfo->id }})">編集</button>
                    </div>

                    {{-- レビューエリア（最初は非表示） --}}
                    <div id="review-area-{{ $episodeInfo->id }}" style="display:none;">

                        {{-- 投稿フォーム --}}
                        @auth
                            @if($episodeInfo->episodeReviews->where('user_id', auth()->id())->isEmpty())
                                <form method="POST" action="/episode/{{ $episodeInfo->id }}/review">
                                    @csrf
                                    <textarea name="review" rows="5" style="width: 400px; font-size: 16px;" placeholder="レビューを入力"></textarea>
                                    <br>
                                    <input type="hidden" name="score" id="score-new-{{ $episodeInfo->id }}" value="60">
                                    <span>
                                        @for($i = 1; $i <= 5; $i++)
                                            <span id="star-new-{{ $episodeInfo->id }}-{{ $i }}"
                                                  onclick="selectStar('new-{{ $episodeInfo->id }}', {{ $i }})"
                                                  style="cursor:pointer; font-size: 24px;">
                                                {{ $i === 1 ? '★' : '☆' }}
                                            </span>
                                        @endfor
                                    </span>
                                    <button type="submit">投稿</button>
                                </form>
                            @endif
                        @else
                            <p><a href="/login">ログイン</a>するとレビューを投稿できます</p>
                        @endauth

                        {{-- レビュー一覧 --}}
                        @foreach($episodeInfo->episodeReviews as $review)
                            <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0; width: 50%;">

                                {{-- 通常表示 --}}
                                <div id="review-show-{{ $review->id }}">
                                    @php
                                        $starMap = [60=>1, 70=>2, 80=>3, 90=>4, 100=>5];
                                        $stars = $starMap[$review->score] ?? 0;
                                    @endphp
                                    <p><strong>{{ $review->user->name }}</strong>　{{ str_repeat('★', $stars) }}{{ str_repeat('☆', 5-$stars) }}</p>
                                    <p>{!! nl2br(e($review->review)) !!}</p>
                                    @auth
                                        @if(auth()->id() === $review->user_id)
                                            <button onclick="startReviewEdit({{ $review->id }})">編集</button>
                                        @endif
                                    @endauth
                                </div>

                                {{-- 編集フォーム（最初は非表示） --}}
                                <div id="review-edit-{{ $review->id }}" style="display:none;">
                                    <form method="POST" action="/episode/review/{{ $review->id }}/update">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="review" rows="5" style="width: 400px; font-size: 16px;">{{ $review->review }}</textarea>
                                        <br>
                                        <input type="hidden" name="score" id="score-edit-{{ $review->id }}" value="{{ $review->score }}">
                                        <span>
                                            @php
                                                $starMap = [60=>1, 70=>2, 80=>3, 90=>4, 100=>5];
                                                $currentStar = $starMap[$review->score] ?? 1;
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <span id="star-edit-{{ $review->id }}-{{ $i }}"
                                                      onclick="selectStar('edit-{{ $review->id }}', {{ $i }})"
                                                      style="cursor:pointer; font-size: 24px;">
                                                    {{ $i <= $currentStar ? '★' : '☆' }}
                                                </span>
                                            @endfor
                                        </span>
                                        <button type="submit">完了</button>
                                        <button type="button" onclick="cancelReviewEdit({{ $review->id }})">キャンセル</button>
                                    </form>
                                </div>

                            </div>
                        @endforeach

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

        function toggleReview(id) {
            const area = document.getElementById('review-area-' + id);
            area.style.display = area.style.display === 'none' ? 'block' : 'none';
        }

        function startReviewEdit(id) {
            document.getElementById('review-show-' + id).style.display = 'none';
            document.getElementById('review-edit-' + id).style.display = 'block';
        }

        function cancelReviewEdit(id) {
            document.getElementById('review-edit-' + id).style.display = 'none';
            document.getElementById('review-show-' + id).style.display = 'block';
        }

        // 点数を☆に変換
        function scoreToStars(score) {
            const map = {60: 1, 70: 2, 80: 3, 90: 4, 100: 5};
            const stars = map[score] || 0;
            return '★'.repeat(stars) + '☆'.repeat(5 - stars);
        }

        // ☆選択
        function selectStar(formId, stars) {
            const scoreMap = {1: 60, 2: 70, 3: 80, 4: 90, 5: 100};
            document.getElementById('score-' + formId).value = scoreMap[stars];
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star-' + formId + '-' + i);
                star.textContent = i <= stars ? '★' : '☆';
            }
        }
        const reviewParams = new URLSearchParams(window.location.search);
        const reviewEpisodeId = reviewParams.get('review');
        if (reviewEpisodeId) {
            const area = document.getElementById('review-area-' + reviewEpisodeId);
            if (area) area.style.display = 'block';
        }
    </script>
</x-app-layout>
