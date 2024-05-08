<?php

namespace App\Imports;

use App\Models\Fo;
use App\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LeadsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // $leads = [];

        // $lead = [
        //     'name' => $row['name'],
        //     'email' => $row['email'],
        //     'mobile' => $row['mobile'],
        //     'address' => $row['address'],
        //     'time' => $row['time'],
        //     'fo_id' => $this->getFoId($row['fo_code'])
        // ];
        // $leads[] = $lead;
        // dd($leads);
        return new Leads([
            'name' => $row['name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'address' => $row['address'],
            'time' => $row['time'],
            'fo_id' => $this->getFoId($row['fo_code'])
        ]);

        // return 

    }

    private function getFoId($code)
    {

        $fo = Fo::where('fo_code', $code)->first();
        if ($fo) {
            return $fo->id;
        } else {
            return null;
        }

    }

}


