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
        ->select(
        	     'employees.employee_id',
                 'employees.name',
                 'roles.alias',
        	     'pettycash_overviews.total_issued',
        	     'pettycash_overviews.total_balance' 
         )    
         ->join('employees', 'pettycash_overviews.user_id', '=', 'employees.user_id')
         ->join('roles', 'employees.role', '=', 'roles.name')
         ->orderBy('pettycash_overviews.id', 'DESC')
        ->get();

        return $att ;

    }

    public function headings(): array
     {       
       return [
         'Employee ID' ,'Name', 'Role', 'Issued Amount' , 'Balance Amount'];
     }
}
