<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class Hellocontroller extends Controller
{
    public function form(Request $request) {
        echo $request->session()->get('id');
        if(empty($request->msg)) {
            // エラーなしの場合
             $data = [
                'msg'=>''
                ];
        } else {
            // エラーがある場合
            $data = [
                'msg'=>'ＩＤが重複しています'
                ];
        }
        $items = DB::select('SELECT * FROM user_table;');
        return view('test.form',$data);
    }
    
    public function post(Request $request) {
        $request->session()->put('id',$request->id);
        $validate_rule = [
            'id' => 'required',
            'passcode' => 'required',
            'name' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $items = DB::select('SELECT * FROM user_table where id=:id;',['id'=>$request->id]);
        if(count($items)==0) {
            // 登録されていない場合
            $data = [
                'id'=>$request->id,
                'passcode'=>$request->passcode,                
                'name'=>$request->name,
                ];
            return view('test.post',$data); 
        } else {
            // 登録されている場合
            return redirect('/?msg=1');
        }
        
    }
    
    public function complete(Request $request) {
        $data = [
            'id'=>$request->id,
            'passcode'=>$request->passcode,                
            'name'=>$request->name,
        ];
        DB::insert('insert into user_table(id, passcode, name) values(:id, :passcode, :name)', $data);
        return view('test.complete',$data);
    }
}