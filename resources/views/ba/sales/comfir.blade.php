<h3>入力内容を確認します</h3>
<p>【ユーザーＩＤ】{{$user_id}}</p>
<p>【パスワード】{{$password}}</p>
<p>【お名前】{{$user_name}}</p>
<div>
    <form action="/app/public/input" method="post">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_back">戻る</button>
        <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
        <input type="hidden" id="password" name="password" value="{{$password}}">
        <input type="hidden" id="user_name" name="user_name" value="{{$user_name}}">
    </form>
    <form action="/app/public/comp" method="post">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_comp">送信</button>
        <input type="text" id="user_id" name="user_id" value="{{$user_id}}">
        <input type="text" id="password" name="password" value="{{$password}}">
        <input type="text" id="user_name" name="user_name" value="{{$user_name}}">
    </form>   
</div>