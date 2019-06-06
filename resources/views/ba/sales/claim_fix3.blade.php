<form action="/app/public/claim_comp3" method="post">
    {{ csrf_field() }}
    <div>
        <label for="product_id">商品コード：</label>
        <input type="text"  id="product_id" name="product_id" value="{{$product_id}}">
    </div>
    <div>
        <label for="product_name">商品名：</label>
        <input type="text"  id="product_name" name="product_name" value="">
    </div>
    
    <button type="sumbit" name="btn_claim_comp">登録</button>
</form>