<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        print_r($array); die();
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'role_id' => $row[2],
            'role' => $row[3],
            'password' => Hash::make($row[4]),
        ]);
    }
}
