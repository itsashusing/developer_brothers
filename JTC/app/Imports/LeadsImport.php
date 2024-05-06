<?php

namespace App\Imports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\StartRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Leads([
            'name' => $row['name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'address' => $row['address'],
            'time_in_minuts' => $row['time_in_minuts'],
        ]);
    }
}
