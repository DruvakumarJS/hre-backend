<?php

namespace App\Exports;

use App\Models\Ticket;
use App\Models\TicketConversation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Auth;
use App\Models\Roles;
use App\Models\Employee;

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
        $userIDs=array();
        $ids=array();

       // print_r($this->filter); die();
        if($filter == 'Pending')
        {
          $filter = 'Pending/Ongoing';
          
        }
        
        $user = Auth::user();
        
       // print_r($search);  print_r($filter);  die();

         if($search == '' && $filter=='all'){
           if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
               $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                 
                 ->get();
            }
            else{

              if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){
                 $role = Roles::select('id')->where('team_id','3')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }

                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '4'){
                $role = Roles::select('id')->where('team_id','4')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '5'){

                $role = Roles::select('id')->where('team_id','5')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
               
              }
              else{
                $userIDs[] = Auth::user()->id;
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
  
              }

             
             
              $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('tickets.creator',$userIDs)
                ->orWhereIn('tickets.id',$ids)     
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                ->get(); 

               // print_r(json_encode($tickets) ); print_r(Auth::user()->id); die();

            }



         }
         elseif($search != '' && $filter=='all'){

          if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
         
               $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                  ->where(function($query)use($search){
                       $query->where('tickets.pcn','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                       $query->orWhere(function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                 ->get();
            }
            else{

              if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){
                 $role = Roles::select('id')->where('team_id','3')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }

                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '4'){
                $role = Roles::select('id')->where('team_id','4')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '5'){

                $role = Roles::select('id')->where('team_id','5')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
               
              }
              else{
                $userIDs[] = Auth::user()->id;
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
  
              }

              $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                 ->where(function($query)use($userIDs,$ids){
                    $query->whereIn('tickets.creator',$userIDs);
                    $query->orWhereIn('tickets.id', $ids);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })
                ->where(function($query)use($search){
                 $query->where('tickets.pcn','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                 $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                 $query->orWhere(function($query)use($search){
                    $query->where('pcns.brand' , 'LIKE' , '%'.$search.'%');
                 });

                })
                     
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                ->get();

            }
         }
        elseif($search != '' && $filter!='all'){
        
          if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
               $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                  ->where(function($query)use($search){
                       $query->where('tickets.pcn','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                       $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                       $query->orWhere(function($query)use($search){
                          $query->where('pcns.brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                  ->where(function($query)use($filter){
                      $query->where('tickets.creator' , $filter);
                      $query->orWhere('tickets.status',$filter);
                  })
                  
                 ->get();
            }
            else{

              if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){
                 $role = Roles::select('id')->where('team_id','3')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }

                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '4'){
                $role = Roles::select('id')->where('team_id','4')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '5'){

                $role = Roles::select('id')->where('team_id','5')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
               
              }
              else{
                $userIDs[] = Auth::user()->id;
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
                 ->orWhere(function($query) use($search){
                    $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
                 })
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
  
              }

              //ticket
              $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
               
                 ->where(function($query)use($userIDs,$ids){
                    $query->whereIn('tickets.creator',$userIDs);
                    $query->orWhereIn('tickets.id', $ids);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($filter){
                      $query->where('tickets.creator' , $filter);
                      $query->orWhere('tickets.status',$filter);
                     })
                 ->where(function($query)use($search){
                   $query->where('tickets.pcn','LIKE','%'.$search.'%');
                   $query->orWhere('tickets.pcn','LIKE','%'.$search.'%');
                   $query->orWhere('tickets.ticket_no','LIKE','%'.$search.'%');
                   $query->orWhere('tickets.status','LIKE','%'.$search.'%');
                   $query->orWhere('tickets.category','LIKE','%'.$search.'%');
                   $query->orWhere(function($query)use($search){
                      $query->where('pcns.brand' , 'LIKE' , '%'.$search.'%');
                   });

                 })
    
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                ->get();

              //  print_r(json_encode($tickets)); die();
            }

        }
        elseif($search == '' && $filter != 'All'){
         if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
            //print_r("--441--"); die();
               $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                  
                  ->where(function($query)use($filter){
                      $query->where('tickets.creator' , $filter);
                      $query->orWhere('tickets.status',$filter);
                  })
                  
                 ->get();
            }
            else{

              if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){
                 $role = Roles::select('id')->where('team_id','3')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }

                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '4'){
                $role = Roles::select('id')->where('team_id','4')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
              }
              else if(Auth::user()->roles->team_id == '5'){

                $role = Roles::select('id')->where('team_id','5')->get();
                 $emp= array();
                 foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                    
                }
               $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
               
              }
              else{
                $userIDs[] = Auth::user()->id;
                $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
                 ->groupBy('ticket_id')->get();

                foreach ($ticket_convers as $key => $value) {
                  
                  $ids[]=$value->ticket_id;

                }
  
              }
              //tickets

               $tickets = DB::table('tickets')
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
                
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->where(function($query)use($userIDs,$ids){
                    $query->whereIn('tickets.creator',$userIDs);
                    $query->orWhereIn('tickets.id', $ids);
                    $query->orWhere('tickets.assigned_to' ,Auth::user()->id);
                 })     
                ->where(function($query)use($filter){
                  $query->where('tickets.creator' , $filter);
                  $query->orWhere('tickets.status',$filter);
                 })     
                ->join('pcns', 'pcns.pcn' , '=','tickets.pcn')
                ->orderby('tickets.id' , 'DESC')
                ->get();

              //  print_r(json_encode($tickets)); die();
            }
        }  
        else{
          print_r("Please Contact Super Admin"); die();
        }

        
        return $tickets ;   
    }

    public function headings(): array
     {       
       return [
         'Created Date','Ticket ID', 'PCN' , 'Billing Name' , 'Brand', 'Area' , 'City' , 'category' , 'Description' ,  'Is Reopened' , 'Priority' , 'TAT' , 'Latest Comment' , 'Updated Date','Status'
       ];
     }
}
