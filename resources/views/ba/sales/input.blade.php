<form action="/app/public/comfir" method="post">
    {{ csrf_field() }}
    @isset($msg)
        {{$msg}}
    @endisset
    @if($errors->has('user_id'))
        ユーザーＩＤが入力されていません<br>
    @endif
    @if($errors->has('password'))
        パスワードが入力されていません<br>
    @endif
    @if($errors->has('user_name'))
        名前が入力されていません<br>
    @endif
    <div>
        <label for="user_id">ユーザーＩＤ：</label>
        <input type="text"  id="user_id" name="user_id" value="{{$user_id}}">
    </div>
    <div>
        <label for="password">パスワード：</label>
        <input type="password" id="password" name="password" value="{{$password}}">
    </div> 
    <div>
        <label for="user_name">お名前：</label>
        <input type="text" id="user_name" name="user_name" value="{{$user_name}}">
    </div>
    <div>
        <button type="sumbit" name="btn_comfir">入力を確認する</button>
    </div>
</form>