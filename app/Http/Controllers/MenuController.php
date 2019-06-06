<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function menu(Request $request) {
            return view('ba.sales.menu');
        }
}
