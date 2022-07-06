<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\UuidV3;
use Illuminate\Support\Facades\Hash;

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
            return back()->with("success", "user store deleted succefully.");
        }
        return back()->with("success", "Error Occured.");
    }

    public function enable($store_id)
    {
        $user  = User::where('id',$store_id)->first();
        if ($user->store_status === 1) {
            User::where('id', $user->id)->update(['store_status'=>0]);
        } else {
            User::where('id', $user->id)->update(['store_status'=>1]);
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
            'user_type' => 'merchant'
        ]);


        return redirect()->back()->with('success',"Store ADDED!");
    
    }
}
