<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Roles;
use App\Models\TicketDepartment;
use Mail;
use App\Mail\TicketsMail;
use App\Mail\TicketDetailsMail;
use App\Mail\TicketConversationMail;
use App\Models\FootPrint;
use App\Jobs\SendTicketEmail;
use App\Jobs\SendTicketUpdatesEmail;


class TicketController extends Controller
{

     function index(Request $request){

     	if(isset($request->user_id)){
            $ticketarray= array();
            $final_array=array();
          $role = User::select('role_id')->where('id',$request->user_id)->first(); 

          if($role->role_id == '1' || $role->role_id == '2'){
             $tickets = Ticket::orderBy('id' , 'DESC')->get();
     
        foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
              $userdetail = Employee::where('user_id', $value->creator)->withTrashed()->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'pcn_status' => $pcn_data->status ,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'comments' => $value->comments,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 
          }
          else{

          $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $request->user_id)->orWhere('sender', $request->user_id)->groupBy('ticket_id')->get();

          foreach ($ticket_convers as $key => $value) {
            $ids[]=$value->ticket_id;

          }
  
       if(sizeof($ticket_convers) > 0){
       
        $tickets = Ticket::where(function($query){
            $query->where('status','!=','Resolved');
        })
        ->whereIn('id', $ids)->orWhere('creator', $request->user_id)
        ->orderby('id' , 'DESC')->get();

        foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
             $userdetail = Employee::where('user_id', $value->creator)->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'comments' => $value->comments,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 

       }

       else{
           $tickets = Ticket::where('creator', $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->get();

           foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
              $userdetail = Employee::where('user_id', $value->creator)->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'comments' => $value->comments,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 
       }
     }
     	$count[]= ['Active' => '0' , 'Completed'=> '0' , 'Resolved' => '0'];
        $final_array=['counts' => $count , 'tickets' =>$ticketarray ];

                return response()->json([
                    'status'=> 1,
                    'message' => 'Success' ,
                    'data' => $final_array ]);

	     }

       else {
     	return response()->json([
     			'status'=> 0,
     			'message' => 'UnAuthorized' ,
     			'data' => $ticketarray]);
     }	

     }

     function mytickets(Request $request){

    $ticketarray= array();
    $final_array=array();

    if(isset($request->user_id)){

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

           $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $request->user_id)->groupBy('ticket_id')->get();
            foreach ($ticket_convers as $key => $value) {
             $ids[]=$value->ticket_id;
              }
             // print_r($ids); die();
            if(sizeof($ticket_convers) > 0){
            $tickets = Ticket::whereIn('id', $ids)
            ->orWhereIn('creator',$userIDs)
            ->orWhere('creator', Auth::user()->id)
            ->orderby('id' , 'DESC')->paginate(25);
            }
             else{
                 $tickets = Ticket::whereIn('creator',$userIDs)->orWhere('creator', $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->paginate(25);
            } 


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

            $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $request->user_id)->groupBy('ticket_id')->get();
            foreach ($ticket_convers as $key => $value) {
             $ids[]=$value->ticket_id;
              }
             // print_r($ids); die();
            if(sizeof($ticket_convers) > 0){
            $tickets = Ticket::whereIn('id', $ids)
            ->orWhereIn('creator',$userIDs)
            ->orWhere('creator', Auth::user()->id)
            ->orderby('id' , 'DESC')->paginate(25);
            }
             else{
                 $tickets = Ticket::whereIn('creator',$userIDs)->orWhere('creator', $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->paginate(25);
            } 


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

            $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $request->user_id)->groupBy('ticket_id')->get();
            foreach ($ticket_convers as $key => $value) {
             $ids[]=$value->ticket_id;
              }
             // print_r($ids); die();
            if(sizeof($ticket_convers) > 0){
            $tickets = Ticket::whereIn('id', $ids)
            ->orWhereIn('creator',$userIDs)
            ->orWhere('creator', Auth::user()->id)
            ->orderby('id' , 'DESC')->paginate(25);
            }
             else{
                 $tickets = Ticket::whereIn('creator',$userIDs)->orWhere('creator', $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->paginate(25);
            } 


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

        foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
              $userdetail = Employee::where('user_id', $value->creator)->withTrashed()->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'pcn_status' => $pcn_data->status ,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'comments' => $value->comments,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 

        $count[]= ['Active' => '0' , 'Completed'=> '0' , 'Resolved' => '0'];
        $final_array=['counts' => $count , 'tickets' =>$ticketarray ];

                return response()->json([
                    'status'=> 1,
                    'message' => 'Success' ,
                    'data' => $final_array ]);   

     }
     else{
        return response()->json([
            'status'=> 0,
            'message' => 'UnAuthorized' ,
            'data' => $ticketarray]);
     }

     }


     function create(Request $request){
      
      //  print_r($fileName);die();
        
     	if(isset($request->user_id) && isset($request->pcn) && isset($request->subject) && isset($request->issue))
     	{

     	if(Pcn::where('pcn', $request->pcn)->exists())
        { 
             $fileName = '';
             $imagearray=array();
            if(Ticket::exists()){
            $tickets = Ticket::select('ticket_no')->orderby('id' , 'DESC')->first();

            $arr = explode("TN_00", $tickets->ticket_no);
           // print_r($arr);die();
            $ticket_no = "TN_00".++$arr[1];
        }
        else {
            $ticket_no ="TN_001";
        }

          if($file = $request->hasFile('image')) {

            foreach($_FILES['image']['name'] as $key=>$val){ 
                
               $fileName = basename($_FILES['image']['name'][$key]); 
               $temp = explode(".", $fileName);
                 
                  $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/ticketimages/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["image"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
             
                 
            }
          
          }

          $imageNames = implode(',', $imagearray);


        $Insert = Ticket::create([
            'ticket_no'=> $ticket_no,
            'pcn' => $request->pcn,
            'category' => $request->subject,
            'issue' => $request->issue ,
            'priority' => $request->priority,
            'creator' => $request->user_id ,
            'filename' => $imageNames,
            'status' => 'Created'   
        ]);

        if($Insert){

          $empl = Employee::where('user_id',$request->user_id)->first(); 
          $pcndata = Pcn::where('pcn',$request->pcn)->first();

          $subject = "New Ticket : " .$ticket_no." - ".$request->subject ." - ".$request->pcn." - ".$pcndata->brand;

          $ticketarray = [
             'ticket_no'=> $ticket_no,
             'pcn' => $request->pcn,
             'creator' => $empl->name ,
             'category' => $request->subject,
             'issue' => $request->issue,
             'priority' => $request->priority,
             ];

           
         $departemnt = TicketDepartment::where('department', $request->subject)->first();
         $recipients = $departemnt->roles;

         $array = explode(',', $recipients);

         //print_r($array); die();

         // $emailarray = User::select('email')->where('role_id','1')->orWhere('role_id','2')->get();
          $emailarray = User::select('email')->whereIn('role_id',$array)->orWhereIn('role_id',['1','2','3','4','5'])->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
                 
               }
          SendTicketEmail::dispatch($ticketarray , $subject , $emailid) ;    


            $footprint = FootPrint::create([
                            'action' => 'New Ticket created - '.$ticket_no,
                            'user_id' => $request->user_id,
                            'module' => 'Ticket',
                            'operation' => 'C',
                            'platform' =>'Android'
                        ]);
             return response()->json([
                    'status' => 1 ,
                    'message' => 'Ticket Created',
                    'data' =>['ticket_no'=> $ticket_no] 
                ]);

           
            
            
        }

        }
        else {
            
             return response()->json([
             	'status' => 0 ,
             	'message' => 'PCN does not exist',
                 'data' =>[] 
             ]);
        }

    }
    else{

    	 return response()->json([
             	'status' => 0 ,
             	'message' => 'Insufficient inputs',
                 'data' =>[] 
             ]);

    }
     	 

   }


   function conversation(Request $request){

	   if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no) && isset($request->message) && isset($request->recipient) ){

	   	$Ticket = Ticket::where('ticket_no',$request->ticket_no)->first();
       
        $fileName = '';
        if($Ticket->status == 'Pending/Ongoing' || $Ticket->status == 'Re-Opened' || $Ticket->status == 'Completed'){

            if($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
           // $newfilename = round(microtime(true)) . '.' . end($temp);

            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$request->ticket_no .'_'.++$conversation_id->id. '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);
            
         }

            $conversation = TicketConversation::create([
                'ticket_id' => $request->ticket_id ,
                'ticket_no' => $request->ticket_no ,
                'message' => $request->message ,
                'sender' => $request->user_id ,
                'recipient' => $request->recipient,
                'status' => 'pending',
                'filename' => $fileName]);

            if($conversation){
                $sender = Employee::where('user_id',$request->user_id)->first();
                $recipient = Employee::where('user_id',$request->recipient)->first();
                $pcndata = Pcn::where('pcn',$Ticket->pcn)->first();

                $subject = "New message : " .$Ticket->ticket_no." - ".$Ticket->category ." - ".$Ticket->pcn." - ".$pcndata->brand  ;

                $body = "You have a new message from ".$sender->name." regarding ticket no.".$request->ticket_no;

                $ticketarray = ['ticket_no'=>$Ticket->ticket_no ,'sender' => $sender->name , 'assigned_to' => $recipient->name , 'body' => $body , 'action' => 'reply'];


                 $emailarray=User::where('id',$request->recipient)->orWhereIn('role_id',['1','2'])->get();

                    foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                     
                    }
                  
                SendTicketUpdatesEmail::dispatch($ticketarray , $subject , $emailid) ; 

                $footprint = FootPrint::create([
                    'action' => 'Message from '.$sender->employee_id .' - '. $Ticket->ticket_no,
                    'user_id' => $request->user_id,
                    'module' => 'Ticket',
                    'operation' => 'U',
                    'platform' => 'Android'
                ]);
            
                return response()->json([
                    'status' => 1 ,
                    'message' => 'Message sent'
                 ]);

               
           
            }

        }
        else {
            
            return response()->json([
             	'status' => 0 ,
             	'message' => 'Ticket is closed . You cannot communicate to this ticket No. '
             ]);
        }

	   }   
	   else {

	   	return response()->json([
             	'status' => 0 ,
             	'message' => 'Insufficient inputs'
             ]);


	   }

    }

    function conversation_details(Request $request){
        if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no)){

            $conversation = TicketConversation::where('ticket_id' , $request->ticket_id)->where('ticket_no',$request->ticket_no)->get();
            
            $data=array();

            foreach ($conversation as $key => $value) {
                $images = explode(',', $value->filename);
                $result=[
                    'sender' => $value->mailsender->name ,
                    'recipient' => $value->mailrecipient->name ,
                    'sender_id' => $value->sender,
                    'recipient_id' => $value->recipient ,
                    'message' => $value->message ,
                    'filepath' => url('/').'/ticketimages/',
                    'date' => $value->created_at->toDateTimeString(),
                    'filename' => $images];

                    array_push($data, $result);
            }

            return response()->json([
                'status' => 1 ,
                'message' => 'Success',
                'data'=> $data
             ]);

        }
        else{
            return response()->json([
                'status' => 0 ,
                'message' => 'Insufficient inputs',
                'data'=> $data
             ]);

        }

    }

    function update(Request $request){
        if(isset($request->user_id) && isset($request->subject) && isset($request->issue) && isset($request->ticket_no)){
             
             if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
           // $newfilename = round(microtime(true)) . '.' . end($temp);

            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$request->ticket_no .'_'.++$conversation_id->id. '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);

            $update_ticket = Ticket::where('ticket_no', $request->ticket_no)->update([
                'category' => $request->subject ,
                'issue' => $request->issue,
                'filename' => $fileName,
                'priority' => $request->priority
            ]);

            
         }
         else {
            $update_ticket = Ticket::where('ticket_no', $request->ticket_no)->update([
                'category' => $request->subject ,
                'issue' => $request->issue,
                'priority' => $request->priority
                
            ]);

         }

            if($update_ticket){

            
                $footprint = FootPrint::create([
                            'action' => 'Ticket details are modified by creator - '.$request->ticket_no,
                            'user_id' => $request->user_id,
                            'module' => 'Ticket',
                            'operation' => 'U',
                            'platform' => 'Android'
                        ]);

                return response()->json([
                    'status'=> 1,
                    'message' => 'Ticket updated'
            ]);
            }
            else {
                return response()->json([
                    'status'=> 0,
                    'message' => 'Something went wrong'
            ]);

            }

        }
        else {
            return response()->json([
                'status'=> 0,
                'message' => 'Insufficient Inputs'
            ]);

        }
    }

    public function assign_ticket(Request $request){

       // print_r($request->Input()); die();

        if($request->status == 'Pending/Ongoing'){

            $imageNames = "" ;

            $update = Ticket::where('id',$request->ticket_id)->update([
                    'status' => $request->status,
                    'comments' => $request->comment,
                    'assigned_to' => $request->recipient,
                    'assigner' => $request->user_id,
                    'priority' => $request->priority,
                    'tat' => $request->tat
                     ]);

           if($file = $request->hasFile('image')) {

            foreach($_FILES['image']['name'] as $key=>$val){ 
                
               $fileName = basename($_FILES['image']['name'][$key]); 
                $temp = explode(".", $fileName);
                 
                  $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/ticketimages/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["image"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
            $imageNames = implode(',', $imagearray);
             
                 
            }
          
          }

            $ticket = Ticket::where('id',$request->ticket_id)->first();

           $msg = 'Ticket no '.$ticket->ticket_no .' is assigned to you';

           $conversation = TicketConversation::create([
                'ticket_id' => $ticket->id ,
                'ticket_no' => $ticket->ticket_no ,
                'message' => $request->comment ,
                'sender' => $request->user_id ,
                'recipient' => $request->recipient,
                'status' => 'pending',
                'filename' => $imageNames]);

           if($conversation){

             $recipient_detail = Employee::where('user_id',$request->recipient)->first();
             $creator_detail = Employee::where('user_id',$ticket->creator)->first();
             $assigner_detail = Employee::where('user_id',$request->user_id)->first();  
             $pcndata = Pcn::where('pcn',$ticket->pcn)->first();

             $subject = "Ticket Asigned - " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn . " - ".$pcndata->brand ;

              $body = "New service / compliant ticket is asigned to you. Kindly verify the ticket and do the needful";

             // print_r(json_encode($recipient_detail)); die();
              
              $ticketarray = [
                 'ticket_no'=> $ticket->ticket_no,
                 'assigned_to' => $recipient_detail->name ."-".$recipient_detail->employee_id,
                 'tat' =>$request->tat,
                 'comments' =>$request->comment,
                 'body' => $body,
                 'owner' =>$creator_detail->email,
                 'action' => 'assign'
                 ];

              $emailarray = User::select('email')->whereIn('role_id',['1','2'])->orWhere('id',$request->recipient)->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

                SendTicketUpdatesEmail::dispatch($ticketarray , $subject , $emailid) ;  

                $sta = $request->status;

                      if($sta == 'Pending/Ongoing'){
                        $sta = 'Ongoing';
                      }

                      if($sta == 'Created'){
                        $actions = 'Ticket details are modified by creator - '.$ticket->ticket_no;
                      }
                      else{
                         $actions ='Ticket status is modified as '.$sta.' - '.$ticket->ticket_no;
                      }

                    $footprint = FootPrint::create([
                        'action' => $actions,
                        'user_id' => $request->user_id,
                        'module' => 'Ticket',
                        'operation' => 'U'
                    ]);
                 
                    return response()->json([
                    'status' => 1 ,
                    'message' => 'Ticket Assigned Successfully']);    

               }
             }
    }




    public function modify_ticket_status(Request $request){

      //  print_r($request->Input()); die();

        if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no)){

        $ticket = Ticket::where('id',$request->ticket_id)->first();
        $fileName="";

       if($request->action == 'Completed' ){
           if($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
         
            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$request->ticket_no .'_'.++$conversation_id->id. '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);
            
         }


            $conversation = TicketConversation::create([
                'ticket_id' => $request->ticket_id ,
                'ticket_no' => $request->ticket_no ,
                'message' => "Completed : ".$request->message ,
                'sender' => $request->user_id ,
                'recipient' => $ticket->creator,
                'status' => 'pending',
                'filename' => $fileName]);
            
            if($conversation){
              $pcndata = Pcn::where('pcn',$ticket->pcn)->first();  
              $creator_detail = Employee::where('user_id',$ticket->creator)->first();
              $sender_detail = Employee::where('user_id', $request->user_id)->first();

              $subject = "Ticket Completed : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn." - ".$pcndata->brand;;

              $body = "The Ticket No : ".$ticket->ticket_no." is completed by ".$sender_detail->name." - ".$sender_detail->employee_id.". Completed Comments : ".$request->message;

               $ticketarray = [
                  'ticket_no' => $request->ticket_no , 
                  'owner' => $creator_detail->email , 
                  'body'=> $body , 
                  'assigned_to' => 'All' , 
                  'action' => 'Completed'];

              $emailarray = User::select('email')->whereIn('role_id',['1','2','3','4','5','6','7','8','10','11'])->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

             // Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));

             $updateticket = Ticket::where('id',$ticket->id)->update([
               'status' => $request->action ,'comments' =>$request->message]);

             if($updateticket){
                SendTicketUpdatesEmail::dispatch($ticketarray , $subject , $emailid) ; 

                return response()->json([
                        'status' => 1 ,
                        'message' => 'Ticket Updated Successfully']);   
                    
                
             }
             else {
                 return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not Update ticket']);

             }

            }
            else{
                return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not create conversation']);

            }




        }
         else if($request->action == 'Resolved'){
            $conversation = TicketConversation::create([
                        'ticket_id' => $ticket->id ,
                        'ticket_no' => $ticket->ticket_no ,
                        'message' => 'This ticket is Resolved' ,
                        'sender' => $request->user_id ,
                        'recipient' => $ticket->creator,
                        ]);  

            if($conversation){
            $pcndata = Pcn::where('pcn',$ticket->pcn)->first();
            $creator_detail = Employee::where('user_id',$ticket->creator)->first();
            $sender_detail = Employee::where('user_id', $request->user_id)->first();
               
              $subject = "Ticket Resolved : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn." - ".$pcndata->brand;

              $body = "The Ticket No : ".$ticket->ticket_no." is resolved by ".$sender_detail->name." - ".$sender_detail->employee_id;

               $ticketarray = ['ticket_no' => $request->ticket_no,
                'owner' => $creator_detail->email , 
                'body'=> $body , 
                'assigned_to' => 'All' , 
                'action' => 'Resolved' ];

              
              $emailarray = User::select('email')->whereIn('role_id',['1','2','3','4','5','6','7','8','10','11'])->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

              $updateticket = Ticket::where('id',$ticket->id)->update([
               'status' => $request->action , 'comments' =>$request->message]);

              if($updateticket){
               SendTicketUpdatesEmail::dispatch($ticketarray , $subject , $emailid) ; 

               return response()->json([
                        'status' => 1 ,
                        'message' => 'Ticket Updated Successfully']);
                
             }
             else {
                 return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not Update ticket']);

             }
            }
            else{
                return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not create conversation']);
            }

              

                          

        }


        else {
            return response()->json([
                    'status' => 0 ,
                    'message' => 'No action mentioned']);

        }
       }
        else {
             return response()->json([
                        'status' => 0 ,
                        'message' => 'Insufficient Data']);
        }
    
      
    }

    public function modify_ticket_status_2(Request $request){

      //  print_r($request->Input()); die();

        if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no)){

        $ticket = Ticket::where('id',$request->ticket_id)->first();
        $fileName="";
        if($request->action == 'Completed' ){
           /*if($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
           // $newfilename = round(microtime(true)) . '.' . end($temp);

            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$request->ticket_no .'_'.++$conversation_id->id. '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);
            
         }*/

         $imageNames = "" ;
           if($file = $request->hasFile('image')) {

            foreach($_FILES['image']['name'] as $key=>$val){ 
                
               $fileName = basename($_FILES['image']['name'][$key]); 
                $temp = explode(".", $fileName);
                 
                  $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/ticketimages/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["image"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
            $imageNames = implode(',', $imagearray);
             
                 
            }
          
          }


            $conversation = TicketConversation::create([
                'ticket_id' => $request->ticket_id ,
                'ticket_no' => $request->ticket_no ,
                'message' => $request->message ,
                'sender' => $request->user_id ,
                'recipient' => $ticket->creator,
                'status' => 'pending',
                'filename' => $imageNames]);
            
            if($conversation){

              $subject = "Ticket Completed : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn;

              $body = "The Ticket No. ".$request->ticket_no." is Completed ";
              $ticketarray = ['ticket_no' => $request->ticket_no ];

              $emailarray = User::select('email')->where('id',$ticket->creator)->orWhere('role_id','2')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

             // Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));

             $updateticket = Ticket::where('id',$ticket->id)->update([
               'status' => $request->action ,'comments' =>$request->message]);

             if($updateticket){

                try {
                      Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));
                    } catch (\Exception $e) {
                        return $e->getMessage();
                       
                    } 
                    finally {

                    $footprint = FootPrint::create([
                            'action' => 'Ticket is completed - '.$ticket->ticket_no,
                            'user_id' => $request->user_id,
                            'module' => 'Ticket',
                            'operation' => 'U',
                            'platform' => 'Android'
                        ]);    
                     
                     return response()->json([
                        'status' => 1 ,
                        'message' => 'Ticket Updated Successfully']);
                    }     
                    
                
             }
             else {
                 return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not Update ticket']);

             }

            }
            else{
                return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not create conversation']);

            }




        }
         else if($request->action == 'Resolved'){
            $conversation = TicketConversation::create([
                        'ticket_id' => $ticket->id ,
                        'ticket_no' => $ticket->ticket_no ,
                        'message' => 'This ticket is Resolved' ,
                        'sender' => $request->user_id ,
                        'recipient' => $ticket->creator,
                        ]);  

            if($conversation){
               
              $subject = "Ticket Resolved : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn;

              $body = "The Ticket No. ".$request->ticket_no." is Resolved ";
              $ticketarray = ['ticket_no' => $request->ticket_no ];
              
              $emailarray = User::select('email')->orWhere('role_id','1')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }
              $updateticket = Ticket::where('id',$ticket->id)->update([
               'status' => $request->action , 'comments' =>$request->message]);

              if($updateticket){

                try {
                      Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));
                    } catch (\Exception $e) {
                        return $e->getMessage();
                       
                    } 
                    finally {

                    $footprint = FootPrint::create([
                            'action' => 'Ticket is Resolved - '.$ticket->ticket_no,
                            'user_id' => $request->user_id,
                            'module' => 'Ticket',
                            'operation' => 'U',
                            'platform' => 'Android'
                        ]);     
                     
                     return response()->json([
                        'status' => 1 ,
                        'message' => 'Ticket Updated Successfully']);
                    }     
                    
                
             }
             else {
                 return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not Update ticket']);

             }
            }
            else{
                return response()->json([
                    'status' => 0 ,
                    'message' => 'Could not create conversation']);
            }

              

                          

        }
        else {
            return response()->json([
                    'status' => 0 ,
                    'message' => 'No action mentioned']);

        }
       }
        else {
             return response()->json([
                        'status' => 0 ,
                        'message' => 'Insufficient Data']);
        }
    
      
    }

     function getdepartments(Request $request){

    $data= array();
    if(isset($request->user_id)){
        $data =TicketDepartment::select('department')->get();

        return response()->json([
          'status' => 1 ,
          'message' => 'success',
          'data' => $data
        ]);

    }
    else {
      return response()->json([
                  'status' => 0 ,
                  'message' => 'UnAuthorized/Insufficient data',
                  'data' => $data
                  ]);
    }

   }

   public function searching(Request $request){
        $user_id = $request->user_id;
        $search = $request->search ;
        $ticketarray=array();
        $role_id = Roles::where('name' , $request->role)->first();

         
        if($role_id->id == '1' || $role_id->id == '2' || $role_id->id == '5'){
         $tickets = Ticket::orderby('id' , 'DESC')
                 ->where('pcn','LIKE','%'.$search.'%')
                 ->orWhere('pcn','LIKE','%'.$search.'%')
                 ->orWhere('ticket_no','LIKE','%'.$search.'%')
                 ->orWhere('status','LIKE','%'.$search.'%')
                 ->orWhere('category','LIKE','%'.$search.'%')
                 ->orWhereHas('pcns',function($query)use($search){
                    $query->where('brand' , 'LIKE' , '%'.$search.'%');
                 })
                 ->get();
      }
      else {

          $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $user_id)
             ->where('ticket_no','LIKE','%'.$search.'%')->with('ticket')
             ->orWhere(function($query) use($search){
                $query->wherehas('ticket.pcns', fn($q) => $q->where('brand', 'like', '%' . $search . '%'));
             })
             
             ->groupBy('ticket_id')->get();
          
          foreach ($ticket_convers as $key => $value) {
            
            $ids[]=$value->ticket_id;

          }
         
        
       if(sizeof($ticket_convers) > 0){
     
        $tickets = Ticket::orderby('id' , 'DESC')
                 ->where(function($query)use($user_id){
                    $query->where('creator' , $user_id);
                    $query->orWhere('assigned_to' ,$user_id);
                 })
                 ->where(function($query)use($search){
                     $query->where('ticket_no','LIKE','%'.$search.'%');
                     $query->orWhere('pcn','LIKE','%'.$search.'%');
                      $query->orWhere('category','LIKE','%'.$search.'%');
                     $query->orWhereHas('pcns',function($query)use($search){
                        $query->where('brand' , 'LIKE' , '%'.$search.'%');

                     });

                    // $query->orWhere('category','LIKE','%'.$search.'%');                    
                     //$query->orWhere('status','LIKE','%'.$search.'%');
                     
                 }) 
                /* ->where(function($query){
                     $query->where('status' ,'!=','Resolved');
                 })
                 */
                 ->orWhere(function($query)use($ids){
                    $query->whereIn('id', $ids);
                    $query->where('status' ,'!=','Resolved');
                 }) 
                          
                 ->get();

       }
       else{
     //print_r("ll"); die();
           $tickets = Ticket::where(function($query)use($user_id){
                    $query->where('creator' , $user_id);
                    $query->orWhere('assigned_to' ,$user_id);
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

      foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
              $userdetail = Employee::where('user_id', $value->creator)->withTrashed()->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 

        $count[]= ['Active' => '0' , 'Completed'=> '0' , 'Resolved' => '0'];
        $final_array=['counts' => $count , 'tickets' =>$ticketarray ];

         return response()->json([
                    'status'=> 1,
                    'message' => 'Success' ,
                    'data' => $final_array ]);

   }

   public function search(Request $request){
   
    $user = User::where('id', $request->user_id)->first();
    $search = $request->search ;
    $userid = $user->id;
    $ticketarray=array();

   // print_r($userid); die();

     if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '6'){
               $tickets = Ticket::orderby('id' , 'DESC')
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
            else if($user->role_id == '3' OR $user->role_id == '4' OR $user->role_id == '5'){

              $role = Roles::select('id')->where('team_id','3')->get();
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
                     
                    ->orderby('id' , 'DESC') ->get();


            }
            else if($user->roles->team_id == '4'){

              $role = Roles::select('id')->where('team_id','4')->get();
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
                   ->orderby('id' , 'DESC')->get();


            }
            else if($user->roles->team_id == '5'){

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
                  ->orderby('id' , 'DESC')
                  ->get();


            }
            else { 

              $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', $user->id)
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
             
              $tickets = Ticket::orderby('id' , 'DESC')
                 ->where(function($query)use($userid){
                    $query->where('creator' , $userid);
                    $query->orWhere('assigned_to', $userid);
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
                 $tickets = Ticket::where(function($query)use($userid){
                    $query->where('creator' , $userid);
                    $query->orWhere('assigned_to' ,$userid);
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

        foreach ($tickets as $key => $value) {
             $images = explode(',', $value->filename);
             $pcn_data = Pcn::where('pcn',$value->pcn)->first();
             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
              $userdetail = Employee::where('user_id', $value->creator)->withTrashed()->first();
             $ticketarray[]=[
                    'ticket_creator' => $value->creator,
                    'creator_name' => $userdetail->name,
                    'creator_emplid'=> $userdetail->employee_id,
                    'creator_role'=> $userdetail->user->roles->alias,
                    'ticket_id'=> $value->id ,
                    'ticket_no' => $value->ticket_no ,
                    'pcn' => $value->pcn ,
                    'pcn_detail' => $pcn_detail,
                    'category' => $value->category ,
                    'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => url('/').'/ticketimages/',
                    'status' => $value->status,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 

        $count[]= ['Active' => '0' , 'Completed'=> '0' , 'Resolved' => '0'];
        $final_array=['counts' => $count , 'tickets' =>$ticketarray ];

         return response()->json([
                    'status'=> 1,
                    'message' => 'Success' ,
                    'data' => $final_array ]);


   }

}
