<h3>登録完了</h3>
<p>商品コード：{{$product_id}}</p>
<p>商品名：{{$product_name}}</p>
<form action="/app/public/menu" method="get">
    {{ csrf_field() }}
    <button type="sumbit" name="btn_menu">メニュー画面へ</button>
</form>