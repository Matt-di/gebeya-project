<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantDashboardorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(){
        // dd(auth()->user()->categories);
        return view('client.dashboard');
    }
}
