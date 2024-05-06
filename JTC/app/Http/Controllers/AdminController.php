<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            return view('admin.dashboard');

        } else {
            return view('admin.login')->with('danger', 'First login please');
        }
    }
    public function adminloginpost(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        // return $admin;
        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->put('admin_id', $admin->id);
            return redirect()->route('dashboard')->with('success', 'Login successful');
        } else {
            return back()->with('danger', "Invalid email or password");

        }

    }

    public function adminlogout(Request $request)
    {
        if (Session::has('admin_id')) {
            $request->session()->forget('admin_id');
            return redirect()->route('dashboard')->with('success', 'Logout successful');
        } else {
            return redirect()->route('adminlogin')->with('danger', 'First login please');
        }
    }
}
