<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 1) {
            $users = User::paginate();
            return view("admin.user.index", ['users' => $users]);
        }
        $users = User::where('role', 3)->paginate();
        return view("client.users.index", ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 1) {
            return view('admin.user.create');
        }
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (auth()->check()) {
            $created = User::create([
                'id' => Uuid::uuid4(),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role' => 1,
                'password' => Hash::make('password'),

            ]);
            if ($created) {
                return redirect()->back()->with('message', "Admin Added!");
            }
            return redirect()->back()->with('message', "Admin Added!");
        }
    }

    public function admins()
    {
        $users = User::where('role', 1)->paginate();
        return view("admin.user.index", ['users' => $users]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user  = User::find($id);
        if ($id == auth()->user()->id) {
            return view('client.users.single',compact('user'));
        }
        return view('client.users.show', compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Request $request, User $user)
    {
        // dd($user);
        $user->update(['role' => 2]);
        return redirect()
            ->route('merchant.dashboard', auth()->user()->id)
            ->with('message', "Thank you for upgrading.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', "User deleted");
    }

    public function impersonate(User $user)
    {
        auth()->user()->impersonate($user);
        // session()->put('impersonate_admin_id', Auth::id());
        return redirect()->route('merchant.dashboard', $user->id);
    }

    public function leaveImpersonate()
    {
        Auth::user()->leaveImpersonation();
        // Auth::loginUsingId(session()->get('impersonate_admin_id'));
        return redirect()->route('admin.dashboard');
    }
}
