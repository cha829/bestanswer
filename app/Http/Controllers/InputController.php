<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    public function input(Request $request) {
        $user_id=$request->session()->get('user_id');
        $password=$request->session()->get('password');
        $user_name=$request->session()->get('user_name');
        $data =[
            'user_id'=>$user_id,
            'password'=>$password,                
            'user_name'=>$user_name,
            ];
        
        return view('ba.sales.input',$data);
    }
    
    public function comfir(Request $request) {
        $request->session()->put('user_id',$request->user_id);
        $request->session()->put('password',$request->password);
        $request->session()->put('user_name',$request->user_name);
        $validate_rule = [
            'user_id' => 'required',
            'password' => 'required',
            'user_name' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $items = DB::select('SELECT * FROM user_table where user_id=:user_id;',['user_id'=>$request->user_id]);
        if(count($items)==0) {
            // 登録されていない場合
            $data =[
                'user_id' => $request->user_id,
                'password' => $request->password,
                'user_name' => $request->user_name,
                ];
            return view('ba.sales.comfir',$data);
        } else {
            // 登録されている場合
            $data =[
                'user_id' => $request->user_id,
                'password' => $request->password,
                'user_name' => $request->user_name,
                'msg' => 'ＩＤが重複しています'
                ];
            return view('ba.sales.input',$data);
        }
    }
    
    public function comp(Request $request) {
        $request->session()->put('user_id',$request->user_id);
        $request->session()->put('password',$request->password);
        $request->session()->put('user_name',$request->user_name);
        $validate_rule = [
            'user_id' => 'required',
            'password' => 'required',
            'user_name' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $sql = 'INSERT INTO user_table (user_id, password, user_name) VALUES(:user_id, :password,:user_name);';
        DB::insert($sql, [
	       'user_id'=>$request->user_id,
	       'password'=>$request->password,
	       'user_name'=>$request->user_name,
            ]);
            return view('ba.sales.comp');
    }
        
    public function comperr(Request $request) {
        return redirect('/input');
    }
}
