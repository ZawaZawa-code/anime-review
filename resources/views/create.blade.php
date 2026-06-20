<h1>アニメ登録</h1>

<form method="POST" action="/anime/store">
    @csrf
    <div style="margin-bottom: 10px;">
        <label>タイトル</label><br>
        <input type="text" name="title" style="width: 400px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label>シーズン</label><br>
        <input type="text" name="season" style="width: 400px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label>あらすじ</label><br>
        <textarea name="synopsis" rows="10" style="width: 400px; font-size: 16px;"></textarea>
    </div>

    <button type="submit">保存</button>
</form>
