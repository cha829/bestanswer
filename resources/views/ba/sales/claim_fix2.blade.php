<form action="/app/public/claim_comp2" method="post">
    {{ csrf_field() }}
    <div>
        <label for="client_id">得意先コード：</label>
        <input type="text"  id="client_id" name="client_id" value="">
    </div>
    
    <div>
        <label for="client_name">得意先名：</label>
        <input type="text"  id="client_name" name="client_name" value="">
    </div>
    <button type="sumbit" name="btn_claim_comp">登録</button>
</form>