<form action="/app/public/data_input" method="get">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_back">戻る</button>
    </form>
    <form action="/app/public/data_comp" method="post">
        {{ csrf_field() }}
        <button type="sumbit" name="btn_data_comp">送信</button>
    </form>  
</div>