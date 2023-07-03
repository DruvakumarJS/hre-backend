<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Address;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCustomer implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       $client = $row[0];

        if(Customer::where('name',$row[0])->exists()){

        }
        else {
            $customer = Customer::create([
            'name' => $row[0],
            'brand' => $row[1],
            'mobile' => $row[2],
            'email' => $row[3],
            'telephone' => $row[4], 
        ]);

        }

        $c_id = Customer::select('id')->where('name',$row[0])->first();

         $addres = Address::create([
                'customer_id'=> $c_id->id ,
                'area' => $row[5] , 
                'city' => $row[6] , 
                'state' => $row[7] ,
                'gst' => $row[8] ,

               ]);

        return ;

    }
}
