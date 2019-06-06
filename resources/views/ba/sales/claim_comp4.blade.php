<h3>修正完了</h3>
<p>伝票番号：{{$slip_id}}</p>
<p>数量：{{$num}}</p>
<p>単価：{{$price}}</p>
<form action="/app/public/menu" method="get">
    {{ csrf_field() }}
    <button type="sumbit" name="btn_menu">メニュー画面へ</button>
</form>