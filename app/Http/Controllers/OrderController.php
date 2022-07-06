<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Ramsey\Uuid\Uuid;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        foreach ($orders as $order) {
            $ordersItems[] = $order->orderItems()->get();
        }
        // dd($orders);
        return view('user.order.index', ['orderItems' => $orders, 'orders' => $orders]);
    }

    public function store(User $user,Request $request)
    {
        return view('user.order.store');
    }
    public function singleOrder(User $user,Order $order)
    {
        // $order = Order::where('id', $order_id)->first();
        $ordersItems = $order->orderItems()->paginate(10);
        // dd($ordersItems);\
        return view('user.order.single', ['orderItems' => $ordersItems, "order" => $order]);
    }
    public function addOrder(User $user, Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'provider' => "required"
        ]);

        $carts = $request->user()->carts;
        $total = 0;
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->quantity) {
                return redirect()->route('home')->with("status", "We don have that much quantity in stock");
            }
            $total += $cart->product->price * $cart->quantity;
        }
        $payed = $request->user()->payments()->create([
            'id' => Uuid::uuid4(),
            'provider' => $request->provider,
            'amount' => $total,
            'status' => "Awaiting"
        ]);
        $order = $request->user()->orders()->create([
            'id' => Uuid::uuid4(),
            'payment_id' => $payed->id,
            'total' => $carts->count(),
        ]);
        foreach ($carts as $cart) {
            $order->orderItems()->create([
                'id' => Uuid::uuid4(),
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'status' => "Ordered"
            ]);
            $remain = $cart->product->quantity - $cart->quantity;
            $cart->product->update(['quantity' => $remain]);
            $cart->delete();
        }
        // dd($order->payment());

        return view("user.order.thanks", ["orders" => $order])->with('status', "Your Order has been submitted");
    }

    public function getOrders(Request $request)
    {
        if ($request->user()->user_type == 'merchant') {
            $ordres = Order::latest()->paginate(10);
            return view('client.orders.index', [
                'orders' => $ordres
            ]);
        }
    }

    public function updateStatus(User $user, Order $order, Request $request)
    {
        Order::where('id',$order->id)->update(['status' => $request->order_status]);
        // $order->update();
        // dd($res);   
        return back()->with("status", "updated");
    }

    public function updatePaymentStatus(User $user, Payment $payment, Request $request)
    {
        $payment->update(['status' => $request->payment_status]); 
        return back()->with("status", "updated");
    }
}
