<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchanProductController extends Controller
{
    public function index(){
        return view('client.product.index');
    }
    public function store(Request $request){
        dd($request);
        return view('client.product.index');
    }
}
