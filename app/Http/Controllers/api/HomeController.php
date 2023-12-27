<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\GRN;
use App\Models\User;
use App\Models\Roles;
use App\Models\Pcn;
use App\Models\Employee;
use App\Models\PettycashOverview;

class HomeController extends Controller
{
    public function mydashboard(Request $request){
    	$data=array();
    	if(isset($request->user_id)){
    		if(Attendance::where('user_id' , $request->user_id)->where('date',date('Y-m-d'))->exists()){
    			$attendance = 'P';
    		}
    		else {
    			$attendance = 'A';
    		}

    		/*if(Intend::where('user_id' , $request->user_id)->exists()){
    			$indents = Intend::where('user_id' , $request->user_id)->count();

    		}*/

            /*Indents*/

            $user = User::where('id' , $request->user_id)->first();

            $role_id = $user->role_id ;
           
            if($role_id == 1 OR $role_id == 2 OR $role_id == 10 OR $role_id == 11 OR $role_id == 12) {
               
                $indents = Intend::count();
               }
               elseif($role_id == 3 OR $role_id == 4 OR $role_id == 5){

                $role = Roles::select('id')->where('team_id','3')->get();
                    $emp= array();
                    foreach ($role as $key => $value) {
                       $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                       foreach ($emp as $key2 => $value2) {
                         $userIDs[] = $value2->user_id;
                     }
                      
                    }

                $indents = Intend::whereIn('user_id',$userIDs)->count();
                   

               }
               elseif($role_id == 6 OR $role_id == 7 OR $role_id == 8 OR $role_id == 9){

                $role = Roles::select('id')->where('team_id','4')->get();
                    $emp= array();
                    foreach ($role as $key => $value) {
                       $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                       foreach ($emp as $key2 => $value2) {
                         $userIDs[] = $value2->user_id;
                     }
                      
                    }

            
                $indents = Intend::whereIn('user_id',$userIDs)->count();
               }
               else {
               
                $indents = Intend::where('user_id' ,$request->user_id)->count();
               }

            /*Indents*/
    		

    		/*if(Ticket::where('creator' , $request->user_id)->exists()){
    			$tickets = Ticket::where('creator' , $request->user_id)->count();

    		}
    		else {
    			$tickets = "0";
    		}*/

            /* Tickets */

            $user = User::where('id',$request->user_id)->first();
        $filter="all";
        $search = '';
        $tickets=array();

      if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
         $tickets = Ticket::orderby('id' , 'DESC')->get();
      }
      else if($user->role_id == '3' OR $user->role_id == '4' OR $user->role_id == '5'){

        $role = Roles::select('id')->where('team_id','3')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

            $tickets = Ticket::whereIn('creator',$userIDs)->orderby('id' , 'DESC')->get();


      }
      else if($user->role_id == '7' OR $user->role_id == '8' OR $user->role_id == '9'){

        $role = Roles::select('id')->where('team_id','4')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

            $tickets = Ticket::whereIn('creator',$userIDs)->orderby('id' , 'DESC')->get();


      }
      else if($user->role_id == '10' OR $user->role_id == '11' OR $user->role_id == '12'){

        $role = Roles::select('id')->where('team_id','5')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

            $tickets = Ticket::whereIn('creator',$userIDs)->orderby('id' , 'DESC')->get();


      }
      else { 
        //13 and 14
          $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $request->user_id)->groupBy('ticket_id')->get();

          foreach ($ticket_convers as $key => $value) {
            $ids[]=$value->ticket_id;

          }

        
       if(sizeof($ticket_convers) > 0){
       
        $tickets = Ticket::where(function($query){
            $query->where('status','!=','Resolved');
        })
        ->whereIn('id', $ids)->orWhere('creator', $request->user_id)
        
        ->orderby('id' , 'DESC')->get();
       }
       else{
           $tickets = Ticket::where('creator', $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->get();
       }

      }

        $ticket_c = sizeof($tickets);

            /* Tickets*/

            if(Pcn::exists()){
                $pcn = Pcn::count();
            }
            else{
                 $pcn = '0';
            }


    		if(GRN::where('user_id' , $request->user_id)->where('status', '!=','Received')->exists()){
    			$GRN = GRN::where('user_id' , $request->user_id)->where('status', '!=','Received')->count();

    		}
    		else {
    			$GRN = "0";
    		}

            if(PettycashOverview::where('user_id' , $request->user_id)->exists()){
                $pc = PettycashOverview::where('user_id' , $request->user_id)->first();
                $balance = $pc->total_balance;

            }
            else {
                $balance = "0";
            }


    		$data = ['attendance' => $attendance , 'indents_count' => $indents , 'tickets_count' => $ticket_c ,'grn_count' => $GRN , 'pettycash' => $balance , 'pcn' => $pcn];

    		return response()->json([
    			'status' => 1,
    			'message' => 'Success',
    			'data'=> $data]);


    	}
    	else{
    		return response()->json([
    			'status' => 0,
    			'message' => 'UnAuthorised',
    			'data'=> $data]);
    	}
    }
}
