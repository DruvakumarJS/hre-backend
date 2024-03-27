<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportUsers implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $role;

    public function __construct($role) 
    {
        $this->role = $role;
       
    } 

    public function collection()
    {
        if($this->role == 'All_users'){
           
            $Emp = DB::table('employees')
            ->select(DB::raw("DATE_FORMAT(employees.created_at, '%Y-%m-%d') as date"),
                     'employees.employee_id' , 'employees.name' , 'employees.email' , 'employees.mobile','roles.alias' ,'employees.appversion')
            ->join('roles', 'roles.id' , '=','employees.role_id')
            ->get();
        }
        else{
           
            $Emp = DB::table('employees')
            ->select(DB::raw("DATE_FORMAT(employees.created_at, '%Y-%m-%d') as date"),
                     'employees.employee_id' , 'employees.name' , 'employees.email' , 'employees.mobile','roles.alias','employees.appversion' )
            ->join('roles', 'roles.id' , '=','employees.role_id')
            ->where('role',$this->role)
            ->get();
        }
        return $Emp;
        
    }

    public function headings():array {
    	return ['Date' , 'Employee ID' , 'Name'  , 'Email ID' , 'Mobile' , 'Role' , 'Apk Version'];
    }
}
