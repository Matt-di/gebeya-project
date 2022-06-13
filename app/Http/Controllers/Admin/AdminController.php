<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        if (auth('web_admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function identify(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!auth('web_admin')->attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('status', 'Invalid Credentials');
        }
        return redirect()->route('admin.dashboard');
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'admin_type' => 'required'
        ]);
        if (auth('web_admin')->check()) {
            Admin::create([
                'id' => Uuid::uuid4(),
                'email' => $request->email,
                'username' => $request->username,
                'admint_type' => $request->admin_type,
                'password' => Hash::make('password'),

            ]);
        }
        return back()->with('status', "Admin created");
    }


    public function users()
    {
        $users = Admin::paginate(10);
        return view('admin.list', ['users' => $users]);
    }
}
