<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>2026冬アニメ</title>
</head>
<body>
    <h1>2026冬アニメ</h1>
    <a href="/">← トップへ戻る</a>
    <a href="/anime/create"><button>＋ 作品を追加</button></a>

    @foreach($animes as $anime)
        <h2>{{ $anime->title }}</h2>

        {{-- 通常表示 --}}
        <div id="show-{{ $anime->id }}">
            <p style="border: 1px solid black; padding: 10px; width: 50%;">{!! nl2br(e($anime->review)) !!}</p>
            <p>点数：{{ $anime->score }}</p>
            <button onclick="startEdit({{ $anime->id }})">編集</button>
        </div>

        {{-- 編集フォーム（最初は非表示） --}}
        <div id="edit-{{ $anime->id }}" style="display:none;">
            <form method="POST" action="/anime/{{ $anime->id }}/update">
                @csrf
                @method('PUT')
                <textarea name="review" rows="10" cols="80" style="font-size:16px;">{{ $anime->review }}</textarea>
                <br>
                <button type="submit">完了</button>
                <button type="button" onclick="cancelEdit({{ $anime->id }})">キャンセル</button>
            </form>
        </div>
    @endforeach

    <script>
        function startEdit(id) {
            document.getElementById('show-' + id).style.display = 'none';
            document.getElementById('edit-' + id).style.display = 'block';
        }

        function cancelEdit(id) {
            document.getElementById('edit-' + id).style.display = 'none';
            document.getElementById('show-' + id).style.display = 'block';
        }
    </script>
</body>
</html>
