<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartController extends Controller
{
    use SoftDeletes;


    public function index(User $user)
    {
        return view('user.cart.index');
    }

    public function store(User $user, Product $product, Request $request)
    {
        if ($product->productAdded(auth()->user())) {
            $cart = Cart::where('product_id', $product->id)
                ->where('user_id', $request->user()->id)->get()->first();
            if ($cart->quantity >= $cart->product->quantity) {
                $output = array(['error' => 'Stock limit reached!']);
                return response()->json($output);
            } else {
                $cart->update(['quantity' => (($cart->quantity + 1))]);
                return response()->json($cart);
            }
        }
        $cart = $product->carts()->create([
            'id' => Uuid::uuid4(),
            'user_id' => $request->user()->id,
            'quantity' => 1
        ]);
        return response()->json($cart);
    }

    public function destroy(User $user, Cart $cart)
    {
        Cart::where('id', $cart->id)->delete();
        return back();
    }

    public function updateQuantity(User $user, Cart $cart, Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required'
        ]);
        
        if ($request->quantity > $cart->product->quantity || $request->quantity <= 0) {
            $output = array(['error' => 'We don\' have that much amount in stock!']);
            return response()->json($output);
        } else {
            $cart->update(['quantity' => $request->quantity]);
            $output = array(['success' => 'Quantity Udated']);

            return response()->json($output);
        }
    }
}
