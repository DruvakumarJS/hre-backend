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
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
                    'status' => $value->status,
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
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
                    'status' => $value->status,
                    'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
         } 

       }

       else{
           $tickets = Ticket::where('creator', Auth::user()->id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->get();

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
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
                    'status' => $value->status,
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

          $subject = "New Ticket : " .$ticket_no." - ".$request->subject ." - ".$request->pcn;

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
          $emailarray = User::select('email')->whereIn('role_id',$array)->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
                 
               }
          Mail::to($emailid)->send(new TicketsMail($ticketarray , $subject));

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

	   	$Ticket = Ticket::select('status')->where('ticket_no',$request->ticket_no)->first();
        $fileName = '';
        if($Ticket->status == 'Pending/Ongoing' || $Ticket->status == 'Re-Opened'){

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
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
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


    public function modify_ticket_status(Request $request){

        if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no) && isset($request->message)){

        $ticket = Ticket::where('id',$request->ticket_id)->first();
        $fileName="";
        if($request->action == 'Completed' ){
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
                'recipient' => $ticket->creator,
                'status' => 'pending',
                'filename' => $fileName]);
            
            if($conversation){

              $subject = "Ticket Completed : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn;

              $body = "The Ticket No. ".$request->ticket_no." is Completed ";
              $ticketarray = ['ticket_no' => $request->ticket_no ];

              $emailarray = User::select('email')->where('id',$ticket->creator)->orWhere('role_id','2')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

              Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));

             $updateticket = Ticket::where('id',$ticket->id)->update([
               'status' => $request->action]);

             if($updateticket){
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

   public function search(Request $request){
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
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
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
