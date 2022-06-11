<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Rfc4122\UuidV3;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'user_type' => 'required',
            'password' => 'required|confirmed|max:255',
        ]);

        // dd($request->lastname);
        User::create([
            'id' => UuidV3::uuid4(), 
            'firstname' => $request->firstname,
            'lastname' => $request->lastname, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'user_type' => $request->user_type
        ]);

        auth()->attempt($request->only('emails','password'));

        return redirect()->route('home');
    }
}
