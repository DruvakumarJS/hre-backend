<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\Employee;
use App\Models\Pcn;

class TicketController extends Controller
{

     function index(Request $request){

     	if(isset($request->user_id)){

     	if(Ticket::where('status', 'Pending/Ongoing')->orWhere('creator' , $request->user_id)->exists()){

     		$tickets = Ticket::where('status', 'Pending/Ongoing')->orWhere('creator' , $request->user_id)->orderby('id' , 'DESC')->get();

            $ticketarray= array();
            $final_array=array();

            $active = Ticket::where('status', 'Pending/Ongoing')->where('creator' , $request->user_id)->count();
           // $created = Ticket::where('status', 'Created')->where('creator' , $request->user_id)->count();
            $completed = Ticket::where('status', 'Completed')->where('creator' , $request->user_id)->count();
            $Resolved = Ticket::where('status', 'Resolved')->where('creator' , $request->user_id)->count();

            $count[]= ['Active' => $active , 'Completed'=> $completed , 'Resolved' => $Resolved];

            foreach ($tickets as $key => $value) {
                $images = explode(',', $value->filename);
            	$ticketarray[]=[
                    'ticket_creator' => $value->creator,
            		'ticket_id'=> $value->id ,
            		'ticket_no' => $value->ticket_no ,
            		'pcn' => $value->pcn ,
            		'category' => $value->category ,
            		'message' => $value->issue,
                    'priority' => $value->priority,
                    'filepath' => 'https://hre.netiapps.com/ticketimages/',
            		'status' => $value->status,
            		'created_on' => $value->created_at->toDateTimeString(),
                    'filename' => ($images)];
            }

            $final_array=['counts' => $count , 'tickets' =>$ticketarray ];

	            return response()->json([
	     			'status'=> 1,
	     			'message' => 'Success' ,
	     			'data' => $final_array ]);
	     		

	     	}
	     	else {
	     		return response()->json([
	     			'status'=> 1,
	     			'message' => 'No tickets available' ,
	     			'data' => $ticketarray]);
	     	}

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

            $arr = explode("TN00", $tickets->ticket_no);
           // print_r($arr);die();
            $ticket_no = "TN00".++$arr[1];
        }
        else {
            $ticket_no ="TN001";
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
             return response()->json([
                'status' => 1 ,
                'message' => 'Ticket Created'
             ]);
            
        }

        }
        else {
            
             return response()->json([
             	'status' => 0 ,
             	'message' => 'PCN does not exist'
             ]);
        }

    }
    else{

    	 return response()->json([
             	'status' => 0 ,
             	'message' => 'Insufficient inputs'
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

}
