<?php

namespace App\Http\Controllers;

use App\Models\Fo;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    public function allLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $leads = Leads::with('FO')->paginate(5);
            // return $leads;
            return view('leads.allLeads', compact('leads'));
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }

    public function addLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            if ($request->method() == 'POST') {
                $validate = $request->validate([
                    'name' => 'required|max:255|string',
                    'email' => 'required|email|max:255|unique:leads',
                    'mobile' => 'required|unique:leads|size:10',
                    'address' => 'required|string',
                    'time' => 'required|numeric',
                    'fo' => 'required|exists:fos,id',
                ]);

                $lead = new Leads;
                $lead->name = $request->name;
                $lead->email = $request->email;
                $lead->mobile = $request->mobile;
                $lead->address = $request->address;
                $lead->time = $request->time;
                $lead->fo_id = $request->fo;
                $lead->save();
                return redirect()->route('allLeads')->with('success', "$request->name added successfully");
            } else {
                $fos = Fo::where('status', 1)->get();
                return view('leads.addLeads', compact('fos'));
            }
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }
    public function editleads(Request $request)
    {


        if ($request->session()->has('admin_id')) {
            if ($request->method() == 'PUT') {

                $validate = $request->validate([
                    'name' => 'required|max:255|string',
                    'email' => 'required|email|max:255|unique:leads',
                    'mobile' => 'required|unique:leads|size:10',
                    'address' => 'required|string',
                    'time' => 'required|numeric',
                    'fo' => 'required|exists:fos,id',
                ]);
                $lead = Leads::find($request->id);
                $lead->name = $request->name;
                $lead->email = $request->email;
                $lead->mobile = $request->mobile;
                $lead->address = $request->address;
                $lead->time = $request->time;
                $lead->fo_id = $request->fo;
                $lead->save();
                return redirect()->route('allLeads')->with('success', "$request->name updated successfully");


            } else {
                $lead = Leads::find($request->id);
                $fos = Fo::where('status', 1)->get();
                // return $lead;
                return view('leads.editLead', compact('lead', 'fos'));
            }
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');

        }
    }
    public function leadschagestatus(Request $request)
    {

        if ($request->session()->has('admin_id')) {
            $lead = Leads::find($request->id);
            if ($lead->status == 1) {
                $lead->status = 0;
            } else {
                $lead->status = 1;
            }
            $lead->save();
            return back()->with('success', 'Status changed successfully');

        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
        }
    }

    public function openLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $leads = DB::table('leads')->where('status', '1')->paginate(5);
            return view('leads.openLeads', compact('leads'));
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }
    public function closeLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $leads = DB::table('leads')->where('status', '0')->paginate(5);
            return view('leads.closeLeads', compact('leads'));
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }
    public function timeoutLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $leads = DB::table('leads')->where('status', '2')->paginate(5);
            return view('leads.timeoutLeads', compact('leads'));
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }
    public function notAssignLeads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $leads = DB::table('leads')->where('status', '3')->paginate(5);
            return view('leads.notAssignLeads', compact('leads'));
        } else {
            return redirect()->route('dashboard')->with('danger', 'First login please');
            ;
        }
    }
}
