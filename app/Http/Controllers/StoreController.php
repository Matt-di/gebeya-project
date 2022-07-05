<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        return view('admin.store.index', [
            'stores' => User::where('user_type', 'merchant')->paginate(20)
        ]);
    }

    public function destroy($user_id)
    {
        $userDeleted = User::where('id', $user_id)->delete();
        if ($userDeleted) {
            return back()->with("status", "user store deleted succefully.");
        }
        return back()->with("status", "Error Occured.");
    }

    public function enable(User $user)
    {
        if ($user->store_status === 1) {
            User::where('id', $user->id)->update(['store_status'=>0]);
        } else {
            User::where('id', $user->id)->update(['store_status'=>1]);
        }
        return back();
    }
}
