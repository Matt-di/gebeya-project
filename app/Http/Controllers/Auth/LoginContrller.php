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
        dd($request->email);

    }
}
