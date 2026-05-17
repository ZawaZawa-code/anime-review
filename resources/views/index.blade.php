<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アニメレビューサイト</title>
</head>
<body>
    <h1>アニメレビューサイト</h1>
    <p>Laravelで作成中です</p>
    @foreach($animes as $anime)
        <h2>{{ $anime->title }}</h2>
        <p>{{ $anime->review }}</p>
        <p>{{ $anime->score }}</p>
    @endforeach
</body>
</html>
