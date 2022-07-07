<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //

    public function store(Request $request)
    {
        // dd(auth('web_admin'));
        if (auth('web_admin')->check()){
            $redirect = 'admin.login';
            auth('web_admin')->logout();
        }
        else
            $redirect = 'home';
        auth()->logout();
        return redirect()->route($redirect);
    }
}
