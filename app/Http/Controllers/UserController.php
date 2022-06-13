<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type','client')->get();
        // dd($users[0]->order);
        return view("client.users.index",['users'=>$users]);
    }
}
