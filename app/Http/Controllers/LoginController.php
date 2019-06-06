<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request) {
        $user_id=$request->session()->get('user_id');
        $password=$request->session()->get('password');
        if(empty($request->msg)) {
            // エラーなしの場合
             $data = [
                'msg'=>'',
                'user_id'=>$user_id,
                'password'=>$password,
                ];
        } else {
            // エラーがある場合
            $data = [
                'msg'=>'ＩＤかパスワードに誤りがあります',
                'user_id'=>$user_id,
                'password'=>$password,
                ];
        }
        return view('ba.sales.login',$data);
    }
    
    public function login(Request $request) {
        $request->session()->put('user_id',$request->user_id);
        $request->session()->put('password',$request->password);
        $validate_rule = [
            'user_id' => 'required',
            'password' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $sql = 'SELECT * FROM user_table WHERE user_id=:user_id AND password=:password';
        $data = [
			'user_id'=>$request->user_id,
			'password'=>$request->password,
		    ];
        $items = DB::select($sql, $data);
        if(count($items)==0) {
            // ログイン失敗の場合
            return redirect('/login?msg=1');
        } else {
            // ログイン成功の場合
            return redirect('/menu');
        }
    }
}
