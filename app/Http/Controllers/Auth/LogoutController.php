<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    //

    public function store(Request $request)
    {
        Session::flush();
        
        Auth::logout();

        return redirect('home');
    }
}
