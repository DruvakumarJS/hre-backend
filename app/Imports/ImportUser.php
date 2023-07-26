<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportUser implements ToModel, WithStartRow
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

        $role = $row['4'];

        if($role == 'admin'){
            $role_id = '1';
        }
        else if($role == 'manager'){
            $role_id = '2';
        }
        else if($role == 'procurement'){
            $role_id = '3';
        }
        else if($role == 'supervisor'){
            $role_id = '4';
        }
        else if($role == 'finance'){
            $role_id = '5';
        }
        else {
            $role_id = '0';
        }


        $createuser = User::create([
            'name' => $row[1],
            'email' => $row[2],
            'role_id' => $role_id,
            'role' => $row[4],
            'password' => Hash::make($row[5]),
        ]);

        if($createuser){
             $user=User::select('id')->where('email',$row[2])->first();
        }

        Employee::create([
                'user_id' => $user->id,
                'employee_id' => $row[0] ,
                'name' => $row[1] ,
                'email' => $row[2],
                'mobile' => $row[3],
                'role' => $row[4],  
            ]);

        return;

    }
}
