<form action="/app/public/output_comfir" method="post">
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
<button type="sumbit" name="btn_output_comfir">表示</button>
</from>