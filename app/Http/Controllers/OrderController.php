<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('user.order.index');
    }

    public function store(Request $request)
    {
        return view('user.order.store');
    }
    public function singleOrder(Order $order)
    {
        $orders = OrderItem::find($order->user->id);
        return view('client.orders.single',['orders'=>[$orders]]);
    }
    public function addOrder(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'provider' => "required"
        ]);

        $carts = $request->user()->carts;
        $total = 0;
        foreach ($carts as $cart) {
            if($cart->quantity > $cart->product->quantity){
                return redirect()->route('home')->with("status","Quantity that much not available");
            }
            $total += $cart->product->price * $cart->quantity;
            $request->user()->orderItems()->create([
                'id' => Uuid::uuid4(),
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
            ]);
            $remain = $cart->product->quantity - $cart->quantity;
            $cart->product->update(['quantity'=>$remain]);
            $cart->delete();
        }
        $payed = $request->user()->payments()->create([
            'id' => Uuid::uuid4(),
            'provider' => $request->provider,
            'amount' => $total,
            'status' => "Awaiting"
        ]);
        $request->user()->orders()->create([
            'id' => Uuid::uuid4(),
            'payment_id' => $payed->id,
            'total' => $carts->count(),
        ]);

        return view("user.order.thanks")->with('status',"Your Order has been submitted");
        
    }

    public function getOrders(Request $request)
    {
        if ($request->user()->user_type == 'merchant') {
            $ordres = Order::paginate(20);
            return view('client.orders.index',[
                'orders'=>$ordres
            ]);
        }
    }
}
