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
        <h2><a href="/anime/{{ $anime->id }}">{{ $anime->title }}</a></h2>
    @endforeach

</body>
</html>
