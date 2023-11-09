<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportTicket implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $filter ;
    public $search ;

    public function __construct($filter ) 
    {
        $this->filter = $filter;  
        $this->filter = $filter;     
    } 

    public function collection()
    {
    	$search=$this->search;
        if($this->filter == 'all'){
        	 $att= DB::table('tickets')
           ->select(
                 DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
        		'tickets.ticket_no' ,
        		'tickets.pcn' ,
        		'pcns.client_name',
        		'pcns.area',
        		'pcns.city',
        		'tickets.category' ,
        		'tickets.issue' ,
        		'users.name' ,
        		'tickets.reopened' ,
        		'tickets.priority' ,
        		'tickets.tat' ,
        		'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
        		'tickets.status')
               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->get(); 
        }
        else if($this->filter == 'Reopend'){
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.area',
                'pcns.city',
                'tickets.category' ,
                'tickets.issue' ,
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->where('reopened', '1')
               ->get(); 
        }
        else {
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.area',
                'pcns.city',
                'tickets.category' ,
                'tickets.issue' ,
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->where('tickets.creator' ,$this->filter)
               ->orWhere('tickets.status', $this->filter)
               ->get(); 
        }
        

        return $att ;   
    }

    public function headings(): array
     {       
       return [
         'Created Date','Ticket ID', 'PCN' , 'Billing Name' , 'Area' , 'City' , 'category' , 'Description' ,  'Creator' , 'Is Reopened' , 'Priority' , 'TAT' , 'Latest Comment' , 'Updated Date','Status'
       ];
     }
}
