<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
{
     public function claim_comfir(Request $request) {
        $dt = Carbon::now();
        $year = $dt->year;
        return view('ba.sales.claim_comfir',['year'=>$year]);
    }
    
    public function claim_fix(Request $request) {
        $client_id = $request->client_id;
        $year = $request->year;
        $mouth = $request->mouth;
        $items = DB::table('slip_table')
                ->where('day', 'like', $year.sprintf('%02d', $mouth).'%')
                ->get();
        $products = DB::table('product_table')->get();
        $clients = DB::table('client_table')->get();
        return view('ba.sales.claim_fix',[
            'client_id'=>$client_id,
            'items'=>$items,
            'products'=>$products,
            'clients'=>$clients
            ]);
    }
    
    public function claim_fix2(Request $request) {
        $client_id = $request->client_id;
        return view('ba.sales.claim_fix2',['client_id'=>$client_id]);
    }
    
    public function claim_fix3(Request $request) {
        $items = DB::table('slip_table')->get();
        foreach($items as $item) {
            $product_id = $item->product_id;
        }
        return view('ba.sales.claim_fix3',['product_id'=>$product_id]);
    }
    
    public function claim_fix4(Request $request) {
        $slip_id = $request->slip_id;
        $items = DB::table('slip_table')->get();
        foreach($items as $item) {
            if($slip_id == $item->slip_id) {
            return view('ba.sales.claim_fix4',['item'=>$item]);
            }
        }
        
    }
    
    public function claim_comp2(Request $request) {
        $client_id = $request->client_id;
        $client_name = $request->client_name;
        $validate_rule = [
            'client_id' => 'required',
            'client_name' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $sql = 'INSERT INTO client_table (client_id, client_name) VALUES(:client_id,:client_name);';
        DB::insert($sql, [
	       'client_id'=>$client_id,
	       'client_name'=>$client_name,
            ]);
        return view('ba.sales.claim_comp',[
            'client_id'=>$client_id,
            'client_name'=>$client_name,
            ]);
    }
    
    public function claim_comp3(Request $request) {
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $validate_rule = [
            'product_id' => 'required',
            'product_name' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $sql = 'INSERT INTO product_table (product_id, product_name) VALUES(:product_id,:product_name);';
        DB::insert($sql, [
	       'product_id'=>$product_id,
	       'product_name'=>$product_name,
            ]);
        return view('ba.sales.claim_comp3',[
            'product_id'=>$product_id,
            'product_name'=>$product_name,
            ]);
    }
    
     public function claim_comp4(Request $request) {
        $slip_id = $request->slip_id;
        $num = $request->num;
        $price = $request->price;
        $validate_rule = [
            'slip_id' => 'required',
            'num' => 'required',
            'price' => 'required',
            ];
        $this->validate($request,$validate_rule);
        $sql = 'UPDATE slip_table SET num = :num, price = :price WHERE slip_id=:slip_id';
        DB::update($sql, [
	       'slip_id'=>$slip_id,
	       'num'=>$num,
	       'price'=>$price
            ]);
        return view('ba.sales.claim_comp4',[
            'slip_id'=>$slip_id,
	        'num'=>$num,
	        'price'=>$price
            ]);
    }
}
