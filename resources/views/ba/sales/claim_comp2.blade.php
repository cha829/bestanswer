<h3>登録完了</h3>
<p>得意先コード：{{$client_id}}</p>
<p>得意先名：{{$client_name}}</p>>
<form action="/app/public/menu" method="get">
    {{ csrf_field() }}
    <button type="sumbit" name="btn_menu">メニュー画面へ</button>
</form>