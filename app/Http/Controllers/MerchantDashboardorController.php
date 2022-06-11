<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantDashboardorController extends Controller
{
    public function index(){
        return view('client.dashboard');
    }
}
