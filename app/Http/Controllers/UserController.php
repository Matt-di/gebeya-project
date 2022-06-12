<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('user_type','client')->paginate(10);
        return view("client.users.index",['user'=>$user]);
    }
}
