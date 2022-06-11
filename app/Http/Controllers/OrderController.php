<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    //
    public function index(){
        return view('user.order.index');
    }

    public function store(Request $request){
        return view('user.order.store');
    }

    public function getOrders(Request $request){
        if($request->user()->user_type == 'merchant'){
            return view('client.orders.index');
        }
    }
}
