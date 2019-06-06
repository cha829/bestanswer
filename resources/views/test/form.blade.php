<form action="/app/public/post" method="post">
     @if(count($errors)>0)
         入力に誤りがあります。
     @endif
     {{$msg}}
     {{ csrf_field() }}
        <div>
            @if($errors->has('id'))
                ユーザーＩＤが入力されていません
            @endif
            <label for="id">ユーザーＩＤ：</label>
            <input type="text"  id="id" name="id">
        </div>
        <div>
            <label for="passcode">パスワード：</label>
            <input type="password" id="passcode" name="passcode">
        </div> 
        <div>
            <label for="name">お名前：</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <button type="sumbit" name="btn_post">入力を確認する</button>
        </div>
</form>