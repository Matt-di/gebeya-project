<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Ramsey\Uuid\Uuid;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->role == 2) {
            $ordres = Order::orderBy('created_at', 'desc')->paginate(10);
            // dd(2);
            return view('client.orders.index', [
                'orders' => $ordres
            ]);
        } else {
            // $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
            // foreach ($orders as $order) {
            //     $ordersItems[] = $order->orderItems()->get();
            // }
            // // dd($orders);
            // return view('user.order.index', ['orderItems' => $orders, 'orders' => $orders]);
            return back();
        }
    }

    public function create()
    {
        $carts = session()->get('cart');

        // $carts = auth()->user()->carts;
        return view('user.order.store', compact('carts'));
    }

    public function update(User $user, Order $Order)
    {
    }

    public function show(User $user, Order $order)
    {
        $ordersItems = $order->orderItems()->paginate(10);
        return view('client.orders.show', ['orderItems' => $ordersItems, "order" => $order]);
    }

    public function store(User $user, Request $request)
    {
        $orders = auth()->user()->orders()->paginate();
        return view('user.order.store', ['orders' => $orders]);
    }
    public function userOrder(User $user, Order $order)
    {
        // $order = Order::where('id', $order_id)->first();
        $ordersItems = $order->orderItems()->paginate(10);
        // dd($ordersItems);\
        return view('client.orders.single', ['orderItems' => $ordersItems, "order" => $order]);
    }
    public function singleOrder(User $user, Order $order)
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
        $user = User::create([
            'id' => UuidV4::uuid4(),
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'role' => 3,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $shippment =  $user->userShippment()->create(
            [
                'phone_number' => $request->phone_number,
                'address_line' => $request->address_line,
                'country' => $request->country,
                'state' => $request->state,
                'zip' => $request->zipcode,
            ]
        );

        // $carts = $request->user()->carts;
        $carts = session()->get('cart');
        $total = 0;
        foreach ($carts as $cart) {
            $product = Product::find($cart['id']);
            if ($cart['qty'] > $product->quantity) {
                return redirect()->route('home')->with("status", "We don have that much quantity in stock");
            }
            $total += $cart['price'] * $cart['qty'];
        }
        $payed = $user->payments()->create([
            'id' => Uuid::uuid4(),
            'provider' => $request->provider,
            'amount' => $total,
            'status' => "Awaiting"
        ]);
        $order = $user->orders()->create([
            'id' => Uuid::uuid4(),
            'payment_id' => $payed->id,
            'total' => count($carts),
        ]);
        foreach ($carts as $cart) {
            $product = Product::find($cart['id']);
            $order->orderItems()->create([
                'id' => Uuid::uuid4(),
                'product_id' => $cart['id'],
                'quantity' => $cart['qty'],
                'status' => "Ordered"
            ]);
            $remain = $product->quantity - $cart['qty'];
            $product->update(['quantity' => $remain]);
            session()->forget('cart');
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
        Order::where('id', $order->id)->update(['status' => $request->order_status]);
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
