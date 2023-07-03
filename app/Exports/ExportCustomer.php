<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportCustomer implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         $customer =  DB::table('customers')->select(DB::raw("DATE_FORMAT(`created_at`, '%d-%m-%Y') as date"),'name', 'brand' , 'email' ,'mobile' ,'telephone')->get();

         return $customer;

        /* $customer= DB::table('customers')
        ->select(
            'customers.name',
            'customers.brand',
            'customers.email',
            'customers.mobile',
            'customers.telephone',
            'addresses.area',
            'addresses.city',
            'addresses.state',
            'addresses.gst'
            ) 
        ->join('addresses', 'customers.id', '=', 'addresses.customer_id')
        ->where('date','LIKE' , '%'.date('Y-m').'%' )
        ->get();

        return $att ;*/
    }

    public function headings(): array
     {       
       return [
         'Date','Name','Brand', 'Email' , 'Mobile' ,'Telephone' 
       ];
     }
}
