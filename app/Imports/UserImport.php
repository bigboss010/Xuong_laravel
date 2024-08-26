<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        $dataExport = array();
        $i = 0;
        foreach ($row as $key => $value) {
            $dataExport[$i++] = $value;
        }

        User::create(array(
            'name'    => $dataExport[1] != null ? $dataExport[1] : "",
            'email' => $dataExport[2] != null ? $dataExport[2] : "",
            'password' => $dataExport[3] != null ? $dataExport[3] : "",
            'phoneNumber' => $dataExport[4] != null ? $dataExport[4] : "",
            'address' => $dataExport[5] != null ? $dataExport[5] : "",
            // 'address'   => $dataExport[3] != null ? $dataExport[3] : "",
            // 'gender'    => $dataExport[4] != null ? $dataExport[4] : "",
        ));
    }
}