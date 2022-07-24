<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'admin_type' => 'required'
        ]);
        if (auth('admin')->check()) {
            User::create([
                'id' => Uuid::uuid4(),
                'email' => $request->email,
                'role' => 1,
                'password' => Hash::make('password'),

            ]);
        }
        return back()->with('status', "Admin created");
    }


    public function users()
    {
        $users = User::where('role', 1)->paginate(10);
        return view('admin.list', ['users' => $users]);
    }

    public function getAdmin(Admin $admin)
    {
        $ad = User::where('id', $admin->id)->get(['id', 'username',  "email"])->first();
        return $ad;
    }

    public function delete($admin_id)
    {
        $adminDeleted = User::findById($admin_id)->delete();
        if ($adminDeleted) {
            return back()->with('success', "Deleted Successfully");
        }
        return back()->with('success', "Sorry Error Occurresd!");
    }


    public function impersonate($id)
    {
        $user = User::find($id);

        // Guard against administrator impersonate
        if (!$user->isAdministrator()) {
            Auth::user()->setImpersonating($user->id);
        } else {
            // flash()->error('Impersonate disabled for this user.');
        }

        return redirect()->back();
    }

    public function stopImpersonate()
    {
        Auth::user()->stopImpersonating();

        // flash()->success('Welcome back!');

        return redirect()->back();
    }
}
