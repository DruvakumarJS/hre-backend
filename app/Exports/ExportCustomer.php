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
            'customers.full_name',
            'customers.designation',
            'customers.mobile',
            'customers.email',
            'customers.full_name1',
            'customers.designation1',
            'customers.mobile1',
            'customers.email1',
            'customers.full_name2',
            'customers.designation2',
            'customers.mobile2',
            'customers.email2',
            'customers.full_name3',
            'customers.designation3',
            'customers.mobile3',
            'customers.email3',
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
         'Date','Name','Brand' , 'State' , 'GST No.' , 'Name' , 'Designation' , 'Mobile' , 'Email','Name2' , 'Designation2' , 'Mobile2' , 'Email2', 'Name3' , 'Designation3' , 'Mobile3' , 'Email3','Name4' , 'Designation4' , 'Mobile4' , 'Email4'
       ];
     }
}
