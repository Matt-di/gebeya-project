<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\UuidV3;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class StoreController extends Controller
{

    public function create()
    {
        return "Hello";
    }

    public function products($id)
    {
        $carts = session()->get('cart');
        if ($carts == null)
            $carts = [];
        $categories = Category::all();
        $store = User::find($id);
        return view('home', [
            'products' => $store->products()->paginate(10),
            'categories' => $categories,
            'cart' => $carts
        ])->with('title', $store->name . " Products");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = User::find($id);
        if (auth()->check()) {
            return view('admin.store.show', compact('store'));
        }
        $carts = session()->get('cart');
        if ($carts == null)
            $carts = [];
        return view('home', [
            'products' => $store->products()->paginate(10),
            'categories' => $store->categories()->paginate(10),
            'cart' => $carts
        ])->with('title', $store->name . " Products");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = User::find($id);
        return view('admin.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }
    public function index()
    {
        if (auth()->check())
            return view('admin.store.index', [
                'stores' => User::where('role', 2)->paginate(20)
            ]);
        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];
        $stores = User::where('role', 2)
            ->where('store_status', 1)->paginate();
        return view('user.store.index', compact('stores', 'cart'));
    }
    public function wipe($store_id)
    {
        if (auth()->user()->role == 1) {
            $user = User::find($store_id);
            $user->categories()->delete();
            $user->products()->delete();
            return redirect()->back()->with('message', "Users data wiped out!");
        }
        return redirect()->back()->with('message', "Only Admins can do that!");
    }
    public function destroy($user_id)
    {
        $userDeleted = User::where('id', $user_id)->delete();
        if ($userDeleted) {
            return back()->with("success", "user store deleted succefully.");
        }
        return back()->with("success", "Error Occured.");
    }

    public function enable($store_id)
    {
        $user  = User::find($store_id);
        if ($user->store_status === 1) {
            User::where('id', $user->id)->update(['store_status' => 0]);
        } else {
            User::where('id', $user->id)->update(['store_status' => 1]);
        }
        return back();
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:255',
        ]);
        // dd($request);
        User::create([
            'id' => UuidV3::uuid4(),
            'firstname' => $request->firstname,
            'lastname' => $request->firstname,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2
        ]);


        return redirect()->back()->with('success', "Store ADDED!");
    }
}
