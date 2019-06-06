<h2>メニュー画面</h2>
<form action="/app/public/data_input" method="get">
    {{ csrf_field() }}
    <div>
        <button type="sumbit" name="btn_post">売上データ取込</button>
    </div>
</form>
<form action="/app/public/claim_comfir" method="get">
    {{ csrf_field() }}
    <div>
        <button type="sumbit" name="btn_post">請求データ確認</button>
    </div>
</form>
<form action="/app/public/output" method="get">
    {{ csrf_field() }}
    <div>
        <button type="sumbit" name="btn_post">得意先別売上データ一覧出力</button>
    </div>
</form>