<form action="/app/public/claim_comp4" method="post">
    {{ csrf_field() }}
    <div>
        <label for="slip_id">伝票番号：</label>
        <input type="text"  id="slip_id" name="slip_id" value="{{$item->slip_id}}">
    </div>
    <div>
        <label for="num">数量：</label>
        <input type="text"  id="num" name="num" value="{{$item->num}}">
    </div>
    <div>
        <label for="price">単価：</label>
        <input type="text"  id="price" name="price" value="{{$item->price}}">
    </div>
    <button type="sumbit" name="btn_claim_comp">登録</button>
</form>