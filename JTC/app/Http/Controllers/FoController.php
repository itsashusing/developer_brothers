<?php

namespace App\Http\Controllers;

use App\Models\Fo;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FoController extends Controller
{
    public function allFo(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $fo_data = FO::with('leads')->paginate(5);
            // return $fo_data;
            return view('fo.allFo', compact('fo_data'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }

    public function editFo(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {
            if ($request->method() == 'PUT') {
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'mobile' => 'required|string|size:10',

                    'adhar' => 'required|string|size:12',
                    'pan' => 'required',
                ]);
                $fo = Fo::find($id);
                $fo->name = $request->name;
                $fo->email = $request->email;
                $fo->mobile = $request->mobile;
                if (!empty($request->password)) {
                    $fo->password = Hash::make($request->password);
                }
                $fo->adhar = $request->adhar;
                $fo->pan = $request->pan;
                $fo->save();
                return redirect()->route('allFo')->with('success', 'Fo updated successfully');
            } else {

                $fo_data = Fo::find($id);
            }
            return view('fo.editFo', compact('fo_data'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function addFo(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            if ($request->method() == 'POST') {

                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:fos',
                    'mobile' => 'required|string|size:10|unique:fos',
                    'password' => 'required|min:8',
                    'adhar' => 'required|string|size:12|unique:fos',
                    'pan' => 'required|unique:fos',
                ]);

                $fo = new Fo;

                $fo->name = $request->name;
                $fo->email = $request->email;
                $fo->mobile = $request->mobile;
                $fo->password = Hash::make($request->password);
                $fo->adhar = $request->adhar;
                $fo->pan = $request->pan;
                $fo->save();
                return redirect()->route('allFo')->with('success', 'Fo added successfully');
            } else {

                return view('fo.addFo');
            }
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function activeFo(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $fo_data = DB::table('fos')->where('status', '1')->paginate(5);
            // return $fo_data;
            return view('fo.activefo', compact('fo_data'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function inActiveFo(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $fo_data = DB::table('fos')->where('status', '0')->paginate(5);
            // return $fo_data;
            return view('fo.activefo', compact('fo_data'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function fochagestatus(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {

            $fo = Fo::find($id);
            if ($fo->status == 1) {
                $fo->status = 0;
            } else {
                $fo->status = 1;
            }
            $fo->save();
            return back()->with('success', 'Status changed successfully');
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }

    public function foleads(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {
            $leads = Leads::with('FO')->where('fo_id', $id)->paginate(5);
            // $leads = Leads::with('FO')->paginate(5);    
            // return $leads;
            return view('fo.foLeads', compact('leads'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
}
