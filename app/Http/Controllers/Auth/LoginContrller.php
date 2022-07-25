<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginContrller extends Controller
{

    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (Auth()->user()->role == 2) {
            return route('admin.dashboard');
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function adminIndex()
    {
        return view('admin.login');
    }
    public function index()
    {
        return view('auth.login');
    }

    public function clientLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 1) {
                // dd(auth()->user());
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role == '3'){
                auth()->logout();
                return redirect()->route('home');
            }

            else
                return redirect()->route('merchant.dashboard', auth()->user()->id);
        }
        return back()->with('status', 'Invalid login credentials');
    }
    public function adminLogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back()->with('message', 'Invalid Credentials');
    }
}
