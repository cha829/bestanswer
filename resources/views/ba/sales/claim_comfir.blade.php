<form action="/app/public/claim_fix" method="post">
    {{ csrf_field() }}
<p>年：<br>
<select name="year">
    @for($i=0;$i<3;$i++)
    <option value="{{$year-$i}}">{{$year-$i}}</option>
    @endfor
</select></p>
<p>月：<br>
<select name="mouth">
    @for($i=1;$i<13;$i++)
    <option value="{{$i}}">{{$i}}</option>
    @endfor
</select></p>
    <div>
        <label for="client_id">得意先コード：</label><br>
        <input type="text" id="client_id" name="client_id" value="">
    </div>
<button type="sumbit" name="btn_claim_fix">送信</button>
</from>