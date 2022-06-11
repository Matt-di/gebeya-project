<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index(){
        return view('admin.dashboard');
    }
}
