<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(2);

        if (Auth::check() && Auth::user()->role == 1) {
            // dd(29);
            return $next($request);
        }

        return redirect('login')->with('message', "You don't have admin access.");
    }
}
