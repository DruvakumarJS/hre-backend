<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Address;
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
         $customer =  DB::table('addresses')
         ->select(DB::raw(
            "DATE_FORMAT(addresses.created_at, '%d-%m-%Y') as date"),
            'customers.name' , 
            'addresses.brand',
            'addresses.state',
            'addresses.gst',
            'customers.mobile',
            'customers.mobile1',
            'customers.mobile2',
            'customers.mobile3',
            'customers.email',
            'customers.email1',
            'customers.email2',
            'customers.email3' 
            )
         ->join('customers', 'addresses.customer_id' , '=','customers.id')
         ->get();

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
         'Date','Name', 'Brand' , 'State' , 'GST No.' , 'Mobile' , 'Mobile 1' , 'Mobile 2' , 'Mobile 3' ,
         'Email' , 'Email 1', 'Email 2', 'Email 3' 
       ];
     }
}
