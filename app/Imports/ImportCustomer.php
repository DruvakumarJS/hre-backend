<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Address;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCustomer implements ToModel, WithStartRow
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
       $client = $row[0];

        if(Customer::where('name',$row[0])->exists()){

        }
        else {
            $customer = Customer::create([
            'name' => $row[0],
            'mobile' => $row[4],
            'mobile1' => $row[5],
            'mobile2' => $row[6],
            'mobile3' => $row[7],
            'email' => $row[8],
            'email1' => $row[9],
            'email2' => $row[10],
            'email3' => $row[11], 
        ]);

        }

        $c_id = Customer::select('id')->where('name',$row[0])->first();

         $addres = Address::create([
                'customer_id'=> $c_id->id ,
                'brand' => $row[1],
                'state' => $row[2] ,
                'gst' => $row[3],

               ]);

        return ;

    }
}
