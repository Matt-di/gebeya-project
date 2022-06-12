<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('user.cart.index');
    }

    public function store(Product $product, Request $request){
        if($product->productAdded($request->user()))
        {
            $cart = Cart::where('product_id',$product->id)
                        ->where('user_id',$request->user()->id)->get()->first();
            Cart::where('id',$cart->id)
                ->update(['quantity'=>(($cart->quantity+1))]);
           return back();
        }
        $product->carts()->create([
            'id'=>Uuid::uuid4(),
            'user_id'=>$request->user()->id,
            'quantity'=>1
        ]);
        return back();
    }

    public function destroy(Cart $cart){
        Cart::where('id',$cart->id)->delete();
        return back();
    }

    public function updateQuantity(Cart $cart,Request $request){
        $this->validate($request,[
            'quantity'=>'required'
        ]);
        if($request->quantity > $cart->product->quantity || $request->quantity <=0){
            return back()->with('status',"Quantity not correct");
        }
        $cart->update(['quantity'=>$request->quantity]);
        return back();
    }
}
