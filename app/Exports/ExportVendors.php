<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\VendorDepartment;
use App\Models\VendorStaff;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportVendors implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $search ;

    public function __construct($search ) 
    {
        $this->search = $search;     
    }


    public function collection()
    {
    	if($this->search == ''){
        $customer =  DB::table('vendor_staff')
         ->select(DB::raw(
            "DATE_FORMAT(vendor_staff.created_at, '%d-%m-%Y') as date"),
            'vendor_departments.vid',
            'vendor_staff.name' , 
            'vendor_staff.designation',
            'vendor_staff.mobile',
            'vendor_staff.email',
            'vendor_departments.billing_name',
            'vendor_departments.vendor_type',
            'vendor_departments.gst',
            'vendor_departments.pan',
            'vendor_departments.tin',
            'vendor_departments.building',
            'vendor_departments.area',
            'vendor_departments.location',
            'vendor_departments.city',
            'vendor_departments.state',
            'vendor_departments.pincode',
            'vendor_departments.owner',
            'vendor_departments.mobile',
            'vendor_departments.email',
            )
        
         ->join('vendor_departments', 'vendor_staff.vendor_id' , '=','vendor_departments.id')
         ->orderBy('vendor_departments.vid', 'DESC')
         ->get();
    	}
    	else{
    	$customer =  DB::table('vendor_staff')
         ->select(DB::raw(
            "DATE_FORMAT(vendor_staff.created_at, '%d-%m-%Y') as date"),
            'vendor_departments.vid',
            'vendor_staff.name' , 
            'vendor_staff.designation',
            'vendor_staff.mobile',
            'vendor_staff.email',
            'vendor_departments.billing_name',
            'vendor_departments.vendor_type',
            'vendor_departments.gst',
            'vendor_departments.pan',
            'vendor_departments.tin',
            'vendor_departments.building',
            'vendor_departments.area',
            'vendor_departments.location',
            'vendor_departments.city',
            'vendor_departments.state',
            'vendor_departments.pincode',
            'vendor_departments.owner',
            'vendor_departments.mobile',
            'vendor_departments.email',
            )
         ->where('vendor_departments.vid','LIKE','%'.$this->search.'%')
        ->orWhere('billing_name','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.vendor_type','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.building','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.area','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.city','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.state','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.owner','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.mobile','LIKE','%'.$this->search.'%')
        ->orWhere('vendor_departments.email','LIKE','%'.$this->search.'%')
         ->join('vendor_departments', 'vendor_staff.vendor_id' , '=','vendor_departments.id')
         ->orderBy('vendor_departments.vid', 'DESC')
         ->get();
    	}
        

         return $customer;
    }

    public function headings(): array
     {       
       return [
         'Date','VID','Staff Name','Designation' , 'Mobile' , 'Email' , 'Billing Name' , 'Vendor Type' , 'GST','PAN' , 'TIN' , 'Building' , 'Area', 'Location' , 'City' , 'State' , 'PINCODE','Owner Name' , 'Owner MObile' , 'Owner Email'
       ];
     }
}
