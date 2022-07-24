<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected function authenticated($request,$user){
    //     if($user->role == 1){
    //         return redirect()->intended('admin.dashboard'); //redirect to admin panel
    //     }elseif($user->role == 2){
    //         return redirect()->intended('merchant.dashboard'); //redirect to admin panels
    //     }

    //     return redirect()->intended('/'); //redirect to standard user homepage
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 1) {
                // dd(auth()->user());

                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role == 3)
                return redirect()->route('home', auth()->user()->id);
            else
                return redirect()->route('merchant.dashboard', auth()->user()->id);
        }
        return back()->with('status', 'Invalid login credentials');
    }
}
