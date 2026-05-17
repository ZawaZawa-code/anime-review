<h1>アニメ登録</h1>

<form method="POST" action="/anime/store">
    @csrf
    <div>
        <label>タイトル</label>
        <input type="text" name="title">
    </div>

    <div>
        <label>レビュー</label>
        <textarea name="review"></textarea>
    </div>

    <div>
        <label>点数</label>
        <input type="number" name="score">
    </div>

    <button type="submit">保存</button>
</form>
