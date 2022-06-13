<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index(){
        return view('admin.store.index',[
            'products'=>Product::paginate(20)
        ]);
    }

    public function destroyALl(){
        Cart::getQuery()->delete();
        Product::getQuery()->delete();
        back();
    }
}
