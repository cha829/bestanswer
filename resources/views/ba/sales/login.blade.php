<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="/app/public/login" method="post">
                {{ csrf_field() }}
                {{$msg}}
                @if($errors->has('user_id'))
                    ユーザーＩＤが入力されていません<br>
                @endif
                <div>
                    <label for="user_id">ユーザーＩＤ：</label>
                    <input type="text"  id="user_id" name="user_id" value="{{$user_id}}">
                </div>
                @if($errors->has('password'))
                    パスワードが入力されていません<br>
                @endif
                <div>
                    <label for="password">パスワード：</label>
                    <input type="password" id="password" name="password" value="{{$password}}">
                </div>
                <div>
                    <button type="sumbit" name="btn_post">ログイン</button>
                </div>
            </form>
            <a href="/app/public/input">新規登録はこちらから</a>    
        </div>
    </div>
</div>