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
        <p>{{ $anime->season }}</p>
        <p style="border: 1px solid black; padding: 10px; width: 50%;">{!! nl2br(e($anime->synopsis)) !!}</p>
    @endforeach

</body>
</html>
