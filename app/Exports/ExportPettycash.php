<?php

namespace App\Exports;

use App\Models\Pettycash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportPettycash implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $att= DB::table('pettycash_overviews')
        ->select(DB::raw("DATE_FORMAT(pettycash_overviews.created_at, '%d-%m-%Y') as formatted_dob"),
        	     'employees.name',
                 'employees.employee_id',
                 'roles.alias',
        	     'pettycash_overviews.total_issued',
        	     'pettycash_overviews.total_balance' 
         )    
         ->join('employees', 'pettycash_overviews.user_id', '=', 'employees.user_id')
         ->join('roles', 'employees.role', '=', 'roles.name')
        ->get();

        return $att ;

    }

    public function headings(): array
     {       
       return [
         'Date','Employee Name','Employee ID' ,'Role', 'Issued Amount' , 'Balance Amount'];
     }
}
