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
        
        $user = Auth::user();
        

       // print_r($search);  print_r($filter); 
        
        if($search == '' && $filter=='all'){
          // print_r("--11--"); die();
          if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
            //print_r("lll"); die();
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                 
                 ->get();
            }
            else if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){

              $role = Roles::select('id')->where('team_id','3')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                     
                    ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                    
                   ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                 
                  ->orderby('id' , 'DESC')
                  ->get();


            }
            else { 

              $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
            
             
             ->groupBy('ticket_id')->get();

            
          
          foreach ($ticket_convers as $key => $value) {
            
            $ids[]=$value->ticket_id;

          }
  
             if(sizeof($ticket_convers) > 0){

             // print_r("111"); die();
             
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                 ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                
                
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('id', $ids);
                    $query->where('status' ,'!=','Resolved');
                 }) 
                          
                 ->get();
             }
             else{
              // print_r("222"); die();
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                 
                 ->orderby('id' , 'DESC')
                
                 ->get();
             }

            }
        }
        elseif($search != '' && $filter=='all'){
         // print_r("--22--"); die();

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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                  ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                 ->get();
            }
            else if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){

              $role = Roles::select('id')->where('team_id','3')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                     ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                     
                    ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                    ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                   ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                  ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                  ->orderby('id' , 'DESC')
                  ->get();


            }
            else { 

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

             // print_r("111"); die();
             
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                 ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('pcn','LIKE','%'.$search.'%');
                     $query->orWhere('category','LIKE','%'.$search.'%');
                     $query->orWhereHas('pcns',function($query)use($search){
                        $query->where('brand' , 'LIKE' , '%'.$search.'%');

                     });
   
                 }) 
                
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('id', $ids);
                    $query->where('status' ,'!=','Resolved');
                 }) 
                          
                 ->get();
             }
             else{
              // print_r("222"); die();
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('pcn','LIKE','%'.$search.'%');
                      $query->orWhere('category','LIKE','%'.$search.'%');
                     $query->orWhereHas('pcns',function($query)use($search){
                        $query->where('brand' , 'LIKE' , '%'.$search.'%');
                     });
                     /*$query->orWhere('category','LIKE','%'.$search.'%');                    
                     $query->orWhere('status','LIKE','%'.$search.'%');*/
                     
                 }) 
                /* ->where(function($query){
                    $query->where('status' ,'!=','Resolved');
                 }) */
                 ->orderby('id' , 'DESC')
                
                 ->get();
             }

            }

        }
        elseif($search != '' && $filter!='all'){
        //  print_r("--33--"); die();
           
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                  ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                  ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                  
                 ->get();
            }
            else if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){

              $role = Roles::select('id')->where('team_id','3')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                     ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                    ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                     })
                     
                    ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                    ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                     ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                     })
                   ->orderby('id' , 'DESC')->get();


            }
            else if(Auth::user()->roles->team_id == '5'){
             // print_r("lll");

              $role = Roles::select('id')->where('team_id','5')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
                   }
                    
                  }

                  $tickets = Ticket::whereIn('creator',$userIDs)
                  ->where(function($query)use($search){
                       $query->where('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('pcn','LIKE','%'.$search.'%');
                       $query->orWhere('ticket_no','LIKE','%'.$search.'%');
                       $query->orWhere('status','LIKE','%'.$search.'%');
                       $query->orWhere('category','LIKE','%'.$search.'%');
                       $query->orWhereHas('pcns',function($query)use($search){
                          $query->where('brand' , 'LIKE' , '%'.$search.'%');
                       });

                     })
                    ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                    })
                  ->orderby('id' , 'DESC')
                  ->get();


            }
            else { 

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

             // print_r("111"); die();
             
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                 ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('pcn','LIKE','%'.$search.'%');
                     $query->orWhere('category','LIKE','%'.$search.'%');
                     $query->orWhereHas('pcns',function($query)use($search){
                        $query->where('brand' , 'LIKE' , '%'.$search.'%');

                     });
   
                 }) 
                  ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('id', $ids);
                    $query->where('status' ,'!=','Resolved');
                 }) 
                          
                 ->get();
             }
             else{
              // print_r("222"); die();
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                 ->where(function($query)use($search){
                     $query->where('ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('pcn','LIKE','%'.$search.'%');
                      $query->orWhere('category','LIKE','%'.$search.'%');
                     $query->orWhereHas('pcns',function($query)use($search){
                        $query->where('brand' , 'LIKE' , '%'.$search.'%');
                     });
                     /*$query->orWhere('category','LIKE','%'.$search.'%');                    
                     $query->orWhere('status','LIKE','%'.$search.'%');*/
                     
                 }) 
                ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                 ->orderby('id' , 'DESC')
                
                 ->get();
             }

            }
        }
        elseif($search == '' && $filter != 'All'){
         // print_r("--44--"); die();

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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                  
                  ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                  
                 ->get();
            }
            else if(Auth::user()->role_id == '3' OR Auth::user()->role_id == '4' OR Auth::user()->role_id == '5'){

              $role = Roles::select('id')->where('team_id','3')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                    
                    ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                     })
                     
                    ->orderby('id' , 'DESC')->get();


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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->whereIn('creator',$userIDs)
                    
                     ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                     })
                   ->orderby('id' , 'DESC')->get();


            }
            else if(Auth::user()->roles->team_id == '5'){
             // print_r("lll");

              $role = Roles::select('id')->where('team_id','5')->get();
                  $emp= array();
                  foreach ($role as $key => $value) {
                     $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                     foreach ($emp as $key2 => $value2) {
                       $userIDs[] = $value2->user_id;
                   }
                    
                  }

                  $tickets = Ticket::whereIn('creator',$userIDs)
                  
                    ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                    })
                  ->orderby('id' , 'DESC')
                  ->get();


            }
            else { 

              $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
             ->with('ticket')
            
             ->groupBy('ticket_id')->get();

            
          
          foreach ($ticket_convers as $key => $value) {
            
            $ids[]=$value->ticket_id;

          }
  
             if(sizeof($ticket_convers) > 0){

             // print_r("111"); die();
             
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->orderby('id' , 'DESC')
                 ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                  
                  ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('id', $ids);
                    $query->where('status' ,'!=','Resolved');
                 }) 
                          
                 ->get();
             }
             else{
              // print_r("222"); die();
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
                'users.name' ,
                'tickets.reopened' ,
                'tickets.priority' ,
                'tickets.tat' ,
                'tickets.comments',
                DB::raw("DATE_FORMAT(tickets.updated_at, '%d-%m-%Y') as updateded_date"),
                'tickets.status')
                ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
                 })
                
                ->where(function($query)use($filter){
                      $query->where('creator' , $filter);
                      $query->orWhere('status',$filter);
                  })
                 ->orderby('id' , 'DESC')
                
                 ->get();
             }

            }
        }

        else{
          print_r("Please Contact Super Admin"); die();
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
