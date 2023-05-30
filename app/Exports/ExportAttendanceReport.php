<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class ExportAttendanceReport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $month ;

     public function __construct($month ) 
    {
        $this->month = $month;
        
        
    } 

    public function collection()
    {
          $att= DB::table('attendances')
        ->select(
            'attendances.date',
            'employees.employee_id',
            'employees.name',
            'attendances.login_time',
            'attendances.logout_time',
            'attendances.total_hours'
            ) 
        ->join('employees', 'attendances.user_id', '=', 'employees.user_id')
        ->where('date','LIKE' , '%'.date('Y-m').'%' )
        ->get();

        return $att ;
    }

    public function headings(): array
     {       
       return [
         'Date', 'Employee ID' , 'Name' , 'Login Time' , 'Logout Time' , 'Working minutes'
       ];
     }
}
