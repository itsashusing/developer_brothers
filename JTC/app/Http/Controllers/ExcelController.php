<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use App\Models\Leads;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importleads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            if ($request->isMethod('post')) {
                $request->validate([
                    'file' => 'required|mimes:xlsx,xls,csv',
                ]);
                // $data = Excel::toArray(new LeadsImport, $request->file('file'));
                // return $data;
                try {
                    Excel::import(new LeadsImport, $request->file('file'));
                    return redirect()->back()->with('success', 'Products imported successfully.');
                } catch (\Exception $e) {
                    return redirect()->back()->with('danger', 'Error importing products: ' . $e->getMessage());
                }
            } else {
                return view('excel.importleads');
            }
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function export($status = null)
    {

        // $value = new LeadsExport($status, $fo_id);
        // return $value->collection();


        return Excel::download(new LeadsExport($status), 'leads.xlsx');
    }
}
