<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportAttendance implements FromCollection, WithHeadings
{
	private $user_id;
	private $start_date;
	private $end_date;

    /**
    * @return \Illuminate\Support\Collection
    */

     public function __construct($user_id ,$start_date , $end_date ) 
    {
        $this->user_id = $user_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
    } 

    public function collection()
    {
        $att= DB::table('attendances')
        ->select(DB::raw('date ,login_time , login_location , logout_time , logout_location ,  CONCAT(FLOOR(total_hours/60),"Hr : ",MOD(total_hours,60),"Min") , CONCAT(FLOOR(out_of_work/60),"Hr : ",MOD(out_of_work,60),"Min")')) 
       
        ->where('user_id',$this->user_id )
        ->whereBetween('date', [$this->start_date, $this->end_date])
        ->get();

      //  print_r(json_encode($att)); die();

        return $att ;


    }

    public function headings(): array
     {       
       return [
         'Date','Login Time' , 'Login Location' ,'Logout Time' , 'Logout Location','Working minutes','Out Of Work' 
       ];
     }
}
