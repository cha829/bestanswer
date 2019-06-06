<p>売上データ取込</p>
<form action="/app/public/data_comp" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="datafile">
    <button type="sumbit" name="btn_data_comp">取込確認</button>
</form>