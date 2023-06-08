<?php

namespace App\Imports;

use App\Material;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMaterial implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Material([
            //
        ]);
    }
}
