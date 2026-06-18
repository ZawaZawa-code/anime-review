<h1>アニメ登録</h1>

<form method="POST" action="/anime/store">
    @csrf
    <div style="margin-bottom: 10px;">
        <label>タイトル</label><br>
        <input type="text" name="title" style="width: 400px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label>レビュー</label><br>
        <textarea name="review" rows="10" style="width: 400px; font-size: 16px;"></textarea>
    </div>

    <div style="margin-bottom: 10px;">
        <label>点数</label><br>
        <input type="number" name="score" style="width: 100px;">
    </div>

    <button type="submit">保存</button>
</form>
