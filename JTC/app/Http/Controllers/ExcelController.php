<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Models\Leads;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importleads(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            return view('excel.importleads');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function export($status = null, $fo_id = null)
    {

        $value = new LeadsExport($status, $fo_id);
        return $value->collection();


        // return Excel::download(new LeadsExport($id), 'leads.xlsx');
    }
}
