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
            $Emp = Employee::select( DB::raw("DATE_FORMAT(`created_at`, '%Y-%m-%d') as date") , 'employee_id' , 'name' , 'email' , 'mobile' )->get();
        }
        else{
            $Emp = Employee::select( DB::raw("DATE_FORMAT(`created_at`, '%Y-%m-%d') as date") , 'employee_id' , 'name' , 'email' , 'mobile' )->where('role',$this->role)->get();
        }
        return $Emp;
        
    }

    public function headings():array {
    	return ['Date' , 'Employee ID' , 'Name'  , 'Email ID' , 'Mobile'];
    }
}
