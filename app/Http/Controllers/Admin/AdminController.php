<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;

class AdminController extends Controller
{
    public function index(){
        if(auth('web_admin')->check()){
            return redirect()->route('admin/dashboard');
        }
        return view('admin.login');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(!auth('web_admin')->attempt($request->only('email','password'))){
            return redirect()->back()->with('status','Invalid Credentials');
        }
        return redirect()->route('admin/dashboard');
    }
}
