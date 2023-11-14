<?php

namespace App\Exports;

use App\Models\Ticket;
use App\Models\TicketConversation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Auth;

class ExportTicket implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $filter ;
    public $search ;

    public function __construct($filter,$search ) 
    {
        $this->filter = $filter;  
        $this->search = $search;     
    } 

    public function collection()
    {
    	$search=$this->search;
        $filter=$this->filter;

       // print_r($this->search); die();
        
        if($this->search == '' && $this->filter != ''){

            if($this->filter == 'all'){
             $att= DB::table('tickets')
           ->select(
                 DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->orderBy('tickets.id','DESC')
               ->get(); 
        }
        else if($this->filter == 'Reopend'){
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->orderBy('tickets.id','DESC')
               ->get(); 
        }
        else {
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->orderBy('tickets.id','DESC')
               ->get(); 
        }

        }
        elseif($this->search != '' && $this->filter != ''){

            if($this->filter == 'all'){
            
             $att= DB::table('tickets')
             ->select(
                 DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
                ->where('tickets.pcn','LIKE','%'.$search.'%')
                 ->orWhere('tickets.ticket_no','LIKE','%'.$search.'%')
                 ->orWhere('tickets.status','LIKE','%'.$search.'%')
                 ->orWhere('tickets.category','LIKE','%'.$search.'%')
               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->orderBy('tickets.id','DESC')
               ->get(); 
             }
             else if($this->filter == 'Reopend'){
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->where('tickets.reopened', '1')
               ->where(function($query)use($search){
                 $query->where('tickets.pcn','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                
                 })
               ->orderBy('tickets.id','DESC')
               ->get(); 
            }
            else {
             $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->where(function($query)use($filter){
                $query->where('tickets.creator' , $filter);
                $query->orWhere('tickets.status',$filter);
             })
               ->where(function($query)use($search){
                 $query->where('tickets.pcn','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                
                 })
              
               ->orderBy('tickets.id','DESC')
               ->get(); 
          }
        }
        else{

            if($search == ''){

              $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
        
             ->groupBy('ticket_id')->get();
          
          foreach ($ticket_convers as $key => $value) {
            
            $ids[]=$value->ticket_id;

          }
         
        
       if(sizeof($ticket_convers) > 0){
    
        $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->where(function($query){
                    $query->where('tickets.creator' , Auth::user()->id);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })
                 
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('tickets.id', $ids);
                    $query->where('tickets.status' ,'!=','Resolved');
                 }) 
               ->orderBy('tickets.id','DESC')
               ->get();         

       }
       else{

            $att= DB::table('tickets')
           ->select(
                 DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
                ->where(function($query){
                    $query->where('tickets.creator' , Auth::user()->id);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })

               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->orderBy('tickets.id','DESC')
               ->get();
            

             } 

            }

            else{
            
            $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
             ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
             ->orWhere(function($query) use($search){
                $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
             })
             ->groupBy('ticket_id')->get();
          
          foreach ($ticket_convers as $key => $value) {
            
            $ids[]=$value->ticket_id;

          }
         
        
       if(sizeof($ticket_convers) > 0){
    
        $att= DB::table('tickets')
               ->select(
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
               ->where(function($query){
                    $query->where('tickets.creator' , Auth::user()->id);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('tickets.ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                     $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                       
                 }) 
               
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('tickets.id', $ids);
                    $query->where('tickets.status' ,'!=','Resolved');
                 }) 
               ->orderBy('tickets.id','DESC')
               ->get();         

       }
       else{

            $att= DB::table('tickets')
           ->select(
                 DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y') as formatted_dob"),
                'tickets.ticket_no' ,
                'tickets.pcn' ,
                'pcns.client_name',
                'pcns.brand',
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
                ->where(function($query){
                    $query->where('tickets.creator' , Auth::user()->id);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('tickets.ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                      $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                
                   
                 }) 
               ->join('pcns', 'tickets.pcn', '=', 'pcns.pcn')
               ->join('users', 'tickets.creator', '=', 'users.id')
               ->orderBy('tickets.id','DESC')
               ->get();
            

            } 
           }         
          }
        
        return $att ;   
    }

    public function headings(): array
     {       
       return [
         'Created Date','Ticket ID', 'PCN' , 'Billing Name' , 'Brand', 'Area' , 'City' , 'category' , 'Description' ,  'Creator' , 'Is Reopened' , 'Priority' , 'TAT' , 'Latest Comment' , 'Updated Date','Status'
       ];
     }
}
