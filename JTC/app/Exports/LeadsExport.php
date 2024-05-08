<?php

namespace App\Exports;

use App\Models\Fo;
use App\Models\Leads;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $status;
    protected $fo_id;

    public function __construct($id = null, $fo_id = null)
    {
        $this->status = $id;

    }
    public function collection()
    {
        if ($this->status) {
            $leads_query = Leads::where('status', $this->status)->get();

        } else {

            $leads_query = Leads::all();
        }

        $leads = [];


        foreach ($leads_query as $key => $value) {
            $leads[$key]['id'] = $value->id;
            $leads[$key]['name'] = $value->name;
            $leads[$key]['email'] = $value->email;
            $leads[$key]['mobile'] = $value->mobile;
            $leads[$key]['address'] = $value->address;
            $leads[$key]['time'] = $value->time . ' min';
            $leads[$key]['status'] = $value->status == 1 ? 'Active' : 'Inactive';
            $leads[$key]['fo_code'] = $this->getFoCode($value->fo_id);
            $leads[$key]['fo_name'] = $this->getFoName($value->fo_id);
            $leads[$key]['fo_Email'] = $this->getFoEmail($value->fo_id);
            $leads[$key]['fo_Mobile'] = $this->getFoMobile($value->fo_id);
            $leads[$key]['created_at'] = $value->created_at;
            $leads[$key]['updated_at'] = $value->updated_at;
        }
        return collect($leads);


    }
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Address',
            'Time',
            'Status',
            'Fo Code',
            'Fo Name',
            'Fo Email',
            'Fo Mobile',
            'Created_at',
            'Updated_at',
            // Add more headings as needed
        ];
    }

    private function getFoName($fo_id)
    {
        $fo = Fo::find($fo_id);
        return $fo->name;
    }
    private function getFoEmail($fo_id)
    {
        $fo = Fo::find($fo_id);
        return $fo->email;
    }
    private function getFoMobile($fo_id)
    {
        $fo = Fo::find($fo_id);
        return $fo->mobile;
    }
    private function getFoCode($fo_id)
    {
        $fo = Fo::find($fo_id);
        return $fo->fo_code;
    }
}
