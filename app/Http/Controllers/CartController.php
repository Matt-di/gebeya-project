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
        $carts = auth()->user()->carts();
        return view('user.cart.index', compact('carts'));
    }

    public function store(User $user, Request $request)
    {
        $product = Product::find($request->product_id);
        if (auth()->user()->user_type == "merchant") {
            $output = array(['error' => 'Sorry you are not allowed to do this!']);
            return response()->json($output);
        }
        if ($product->productAdded(auth()->user())) {
            $cart = Cart::where('product_id', $product->id)
                ->where('user_id', $user->id)->get()->first();
            if ($cart->quantity >= $cart->product->quantity) {
                $output = array(['error' => 'Stock limit reached!']);
                return response()->json($output);
            } else {
                $cart->update(['quantity' => (($cart->quantity + 1))]);
                return redirect()->back()->with('message',"Product quantity updated");
            }
        }
        $cart = $product->carts()->create([
            'id' => Uuid::uuid4(),
            'user_id' => $user->id,
            'quantity' => 1
        ]);
        return redirect()->back();
    }

    public function destroy(User $user, Cart $cart)
    {
        Cart::where('id', $cart->id)->delete();
        return back();
    }

    public function show(Cart $cart)
    {
    }


    public function update(User $user, Cart $cart, Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required'
        ]);

        if ($request->quantity <= 0) {
            $output = 'Below 1 is not allowed. Please Correcr!';
        } elseif ($request->quantity > $cart->product->quantity) {
            $output = 'We don\'t have that much amount in stock!';
        } else {
            $cart->update(['quantity' => $request->quantity]);
            $output = 'Quantity Udated';
        }
        return redirect()->back()->with('message', $output);
    }
}
