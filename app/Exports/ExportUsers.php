<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        return Employee::select('employee_id' , 'name' , 'mobile' , 'email')->where('role',$this->role)->get();
    }

    public function headings():array {
    	return ['Employee ID' , 'Name' , 'Mobile' , 'Email ID'];
    }
}
