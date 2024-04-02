<?php

namespace App\Imports;

use App\Models\VendorDepartment;
use App\Models\VendorStaff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportVendor implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public $rowCount = 0;

    public function startRow(): int
    {
        return 2;
    } 

    public function model(array $row)
    {
       ++$this->rowCount;
       $client = $row[0];

        if(VendorDepartment::where('vid_id',$row[0])->exists()){
         $this->rowCount--;
        }
        else {
        	$vidid = 'VID_'.$row[0] ; 
            $customer = VendorDepartment::create([
            'vid_id' => $row[0],
            'vid' => $vidid,
            'billing_name' => $row[1],
            'vendor_type' => $row[2],
            'gst' => $row[3],
            'pan' => $row[4],
            'tin' => $row[5],
            'building' => $row[6],
            'area' => $row[7], 
            'location'=>$row[8],
            'city' => $row[9],
            'state' => $row[10],
            'pincode' => $row[11], 
            'owner'=>$row[12],
            'mobile' => $row[13],
            'email' => $row[14],
        ]);

        }

        $c_id = VendorDepartment::select('id')->where('vid_id',$row[0])->first();

         $addres = VendorStaff::create([
                'vendor_id'=> $c_id->id ,
                'name' => $row[15],
                'designation' => $row[16] ,
                'mobile' => $row[17],
                'email' => $row[18],

               ]);

        return ;

    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
