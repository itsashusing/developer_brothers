<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            return redirect()->route('admin.login')->with('danger', 'First login please');
        }
    }
    public function profile(Request $request)
    {
        if (Session::has('admin_id')) {
            $admin = Admin::where('id', Session::get('admin_id'))->first();
            return view('admin.editAdmin', compact('admin'));
        } else {
            return redirect()->route('admin.login')->with('danger', 'First login please');
        }
    }
    public function changepassword(Request $request)
    {
        if (Session::has('admin_id')) {
            $admin = Admin::where('id', Session::get('admin_id'))->first();

            if ($request->isMethod('PUT')) {
                $validate = $request->validate([
                    'email' => 'required|email',
                    'oldpassword' => 'required',
                    'newpassword' => 'required'
                ]);


                $newadmin = Admin::where('email', $request->email)->first();

                if ($newadmin && Hash::check($request->oldpassword, $newadmin->password)) {
                    $newadmin->password = Hash::make($request->newpassword);
                    $newadmin->save();
                    return redirect()->route('dashboard')->with('success', 'Password changed successfully');
                } else {
                    return back()->with('danger', 'Old password not matched');
                }
            }
            return view('admin.changepassword', compact('admin'));
        } else {
            return redirect()->route('admin.login')->with('danger', 'First login please');
        }
    }
    public function fogotpassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $password = str(rand(10000000, 99999999));
            $admin = Admin::where('email', $request->email)->first();
            if ($admin != null) {
                $admin->password = Hash::make($password);
                $admin->save();
                $mailData['title'] = 'Hello Admin';
                $mailData['body'] = "Your New Password is: " . $password;
                Mail::to($request->email)->send(new ForgotPassword($mailData));
                return redirect()->route('dashboard')->with('success', 'Password sent to your email');
            } else {
                return back()->with('danger', 'Email not found');
            }

        } else {

            return view('admin.fogotpassword');
        }
    }
}
