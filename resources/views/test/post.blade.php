<h3>入力内容を確認します</h3>
<p>【ユーザーＩＤ】{{$id}}</p>
<p>【パスワード】{{$passcode}}</p>
<p>【お名前】{{$name}}</p>
<div>
    <form action="/app/public" method="post">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_back">戻る</button>
        <input type="hidden" id="id" name="id" value="{{$id}}">
        <input type="hidden" id="passcode" name="passcode" value="{{$passcode}}">
        <input type="hidden" id="name" name="name" value="{{$name}}">
    </form>
    <form action="/app/public/complete" method="post">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_complete">送信</button>
        <input type="hidden" id="id" name="id" value="{{$id}}">
        <input type="hidden" id="passcode" name="passcode" value="{{$passcode}}">
        <input type="hidden" id="name" name="name" value="{{$name}}">
    </form>   
</div>