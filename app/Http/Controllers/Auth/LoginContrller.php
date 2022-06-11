<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginContrller extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request ){

        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);

    if(!auth()->attempt($request->only('email','password'))){
        return back()->with('status','Invalid login credentials');
    }
    if (auth()->user()->user_type=='client')
    return redirect()->route('home');
    else
    return redirect()->route('merchant.dashboard');

    }
}
