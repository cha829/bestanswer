<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use App\Http\Test;

use Carbon\Carbon;

use Symfony\Component\HttpFoundation\StreamedResponse;


class SalesController extends Controller
{
    public function data_index(Request $reques) {
        
        return view('ba.sales.data_input');
    }
    
    public function data_input(Request $reques) {
        
        return view('ba.sales.data_input');
    }
    
    public function data_comfir(Request $request) {
        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('datafile')->store('csv');
        // 行数の数
        $row = 1;
        // ファイルの読み込み
        if (($handle = fopen(storage_path('app/') . $temporary_csv_file, "r")) !== FALSE) {
        	// 読み込んだ行数分ループする
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                    echo "<p> $num fields in line $row: <br /></p>\n";
                if($row==1) {
                    $data = mb_convert_encoding($data,'UTF-8', 'SJIS-win');
                }
        		for ($c=0; $c < 7; $c++) {
        		    echo $data[$c] .  "," . "\n";
                }
        	    $row++;
            }
        }
        // ファイをクローズ
        fclose($handle);
        // 後始末でファイル削除
        unlink(storage_path('app/') . $temporary_csv_file);
        
        return view('ba.sales.data_comfir');
    }
    
    public function data_comp(Request $request) {
        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('datafile')->store('csv');
        // 行数の数
        $row = 1;
        // 添付ファイルを読み込む
        if (($handle = fopen(storage_path('app/') . $temporary_csv_file, "r")) !== FALSE) {
        	// 読み込んだ行数分ループする
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            	// １行目はヘッダーなので無視
                if($row == 1){
                	echo "$row"."行目"."ヘッダーなのでDB登録なし"."<br>";
                }
                // 2行目以降はデータなので処理する
                if($row > 1) {
                    echo "$row"."行目"."個数チェック"."<br>";
                    // データの個数を取得
                    $num = count($data);
                    // 7個未満なら、エラー処理
                    if($num == 7){
                        for($c=0; $c<7; $c++) {
                            if($data[$c]==""){
                                echo "$c"."番目"."空白エラー"."<br>";
                                return view('ba.sales.data_error'); 
                                // ファイをクローズ
                                fclose($handle);
                                // 後始末でファイル削除
                                unlink(storage_path('app/') . $temporary_csv_file);
                            }
                        }
                    } else {
                        return view('ba.sales.data_error');
                        // ファイをクローズ
                        fclose($handle);
                        // 後始末でファイル削除
                        unlink(storage_path('app/') . $temporary_csv_file);
                    }
                }
                $row++;
            }
        }
        // ファイをクローズ
        fclose($handle);
        // エラーがなかったらDBへ登録
        $row = 1;
        // 添付ファイルを読み込む
        if (($handle = fopen(storage_path('app/') . $temporary_csv_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            	// １行目はヘッダーなので無視
                if($row == 1){
                	// echo "ヘッダーなのでDB登録なし"."<br>";
                	$row++;
                }
                // ２行目以降はデータなので処理する
                else {
                	$sql = 'INSERT INTO slip_table (day, depart_id, client_id,product_id,tax_id,num,price) VALUES(:day, :depart_id,:client_id,:product_id,:tax_id,:num,:price);';
                        DB::insert($sql, [
                            'depart_id'=>$data[0],
                            'day'=>$data[1],
                            'client_id'=>$data[2],
                            'tax_id'=>$data[3],
                            'product_id'=>$data[4],
                            'num'=>$data[5],
                            'price'=>$data[6],
                        ]);
                }
                $row++;
            }
            // ファイをクローズ
            fclose($handle);
            // 後始末でファイル削除
            unlink(storage_path('app/') . $temporary_csv_file);
            
            return view('ba.sales.data_comp');
        }
    }
        
    public function output(Request $request) {
        $dt = Carbon::now();
        $year = $dt->year;
        return view('ba.sales.output',['year'=>$year]);
    }
    
    public function output_comfir(Request $request) {
        $year = $request->year;
        $mouth = $request->mouth;
        $items = DB::table('slip_table')
                ->where('day', 'like', $year.sprintf('%02d', $mouth).'%')
                ->get();
        $products = DB::table('product_table')->get();
        $clients = DB::table('client_table')->get();
        return view('ba.sales.output_comfir',[
            'year'=>$year,
            'mouth'=>$mouth,
            'items'=>$items,
            'products'=>$products,
            'clients'=>$clients
            ]);
    }
    
    public function output_execu(Request $request) {
        $items = DB::table('slip_table')->get();
        $clients = DB::table('client_table')->get();
        foreach ($clients as $client) {
                $totals= 0;
                $tax_total= 0;
                $taxs= 0;
                    foreach ($items as $item) {
                        $client_id = $client->client_id;
                        $client_name = $client->client_name;
                        if($client_id == $item->client_id) {
                            $total = $item->num * $item->price;
                            $totals += $total;
                            if($item->tax_id == 1) {
                                $tax = $item->num * $item->price;
                                $tax_total += $tax;
                            }
                        }
                        $taxs = $tax_total * 0.08;
                        $tax_totals = $totals + $taxs;
                    }
                    echo $client_name;
                    echo $totals;
                    echo $taxs;
                    echo $tax_totals.'<br>';
            }
        return view('ba.sales.output_execu');
    }
    
    public function output_export( Request $request ) {
        $response = new StreamedResponse (function() use ($request){
            // ファイルを開く
            $stream = fopen('php://output', 'w');
            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
            // タイトルを追加
            fputcsv($stream, ['得意先名','売上金額','消費税','税込金額']);
            $items = DB::table('slip_table')->get();
            $clients = DB::table('client_table')->get();
            foreach ($clients as $client) {
                $totals= 0; // 売上金額合計
                $tax_total= 0;  // 課税対象合計
                $taxs= 0;   // 消費税
                    foreach ($items as $item) {
                        $client_id = $client->client_id;
                        $client_name = $client->client_name;
                        if($client_id == $item->client_id) {
                            $total = $item->num * $item->price;
                            $totals += $total;
                            if($item->tax_id == 1) {
                                $tax = $item->num * $item->price;
                                $tax_total += $tax;
                            }
                        }
                        $taxs = $tax_total * 0.08;
                        $tax_totals = $totals + $taxs;
                    }
                    fputcsv($stream, [$client_name,$totals,$taxs,$tax_totals]);
            }
 
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="MonthlyReport_Sales.csv"');
 
        return $response;
    }
}