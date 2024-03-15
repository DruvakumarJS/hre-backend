<?php

namespace App\Exports;

use App\Models\Footprint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportFootprints implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     private $search ; 

    public function __construct($search) 
    {
    	 $this->search = $search;
    }

    public function collection()
    {
       $search = $this->search ; 
       if($search != ''){
             $data = DB::table('foot_prints')
			    ->select(
			        DB::raw("DATE_FORMAT(foot_prints.created_at, '%d-%m-%Y') as date"),
			        DB::raw("DATE_FORMAT(foot_prints.created_at, '%H:%i') as time"),
			        'foot_prints.module',
			        'foot_prints.action',
			        'employees.name',
			        'employees.employee_id',
			        'foot_prints.platform'
			    )
			    ->join('employees', 'foot_prints.user_id', '=', 'employees.user_id')
			    ->leftJoin('users', 'foot_prints.user_id', '=', 'users.id') // Join with users table
			    ->where('foot_prints.created_at', 'LIKE', $search . '%')
			    ->orWhere('foot_prints.action', 'LIKE', $search . '%')
			    ->orWhere('foot_prints.module', 'LIKE', $search . '%')
			    ->orWhere('employees.name', 'LIKE', '%' . $search . '%') // Search in employees name
			    ->orWhere('employees.employee_id', 'LIKE', '%' . $search . '%') // Search in employees employee_id
			    ->orderBy('foot_prints.id', 'DESC')
			    ->get();
       }
       else{
       	$data = $data =DB::table('foot_prints')
                 ->select(DB::raw("DATE_FORMAT(foot_prints.created_at, '%d-%m-%Y') as date"),
			        DB::raw("DATE_FORMAT(foot_prints.created_at, '%H:%i') as time"),
                 	'foot_prints.module' ,
                 	'foot_prints.action' ,
                 	'employees.name' ,
                    'employees.employee_id' , 
                 	'foot_prints.platform')
                  ->join('employees', 'foot_prints.user_id', '=', 'employees.user_id')
                  ->orderBy('foot_prints.id', 'DESC')->get();

       }

        return $data ; 

    }

    public function headings(): array
    {
    	return ['Date','Time' , 'Module' , 'Action' , 'Employee Name' , 'Employee ID' , 'Platform'];

    }
}
