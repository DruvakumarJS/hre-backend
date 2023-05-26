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

     	if(Ticket::where('creator' , $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->exists()){

     		$tickets = Ticket::where('creator' , $request->user_id)->orWhere('assigned_to', $request->user_id)->orderby('id' , 'DESC')->get();

            foreach ($tickets as $key => $value) {
            	$ticketarray[]=[
            		'ticket_id'=> $value->id ,
            		'ticket_no' => $value->ticket_no ,
            		'pcn' => $value->pcn ,
            		'category' => $value->category ,
            		'message' => $value->issue,
                    'priority' => $value->priority,
            		'status' => $value->status,
            		'created_on' => $value->created_at->toDateTimeString()];
            }

	            return response()->json([
	     			'status'=> 1,
	     			'message' => 'Success' ,
	     			'data' => $ticketarray ]);
	     		

	     	}
	     	else {
	     		return response()->json([
	     			'status'=> 1,
	     			'message' => 'No tickets available' ,
	     			'data' => '']);
	     	}

	     }

       else {
     	return response()->json([
     			'status'=> 0,
     			'message' => 'UnAuthorized' ,
     			'data' => '']);
     }	

     }



     function create(Request $request){
      
      //  print_r($fileName);die();

     	if(isset($request->user_id) && isset($request->pcn) && isset($request->subject) && isset($request->issue))
     	{

     	if(Pcn::where('pcn', $request->pcn)->exists())
        { 
             $fileName = '';
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
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
           // $newfilename = round(microtime(true)) . '.' . end($temp);

            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$ticket_no . '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);
            
          }


        $Insert = Ticket::create([
            'ticket_no'=> $ticket_no,
            'pcn' => $request->pcn,
            'category' => $request->subject,
            'issue' => $request->issue ,
            'priority' => $request->priority,
            'creator' => $request->user_id ,
            'filename' => $fileName,
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
        if($Ticket->status == 'Pending' || $Ticket->status == 'Re-Opened'){

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
                $result=[
                    'sender' => $value->mailsender->name ,
                    'recipient' => $value->mailrecipient->name ,
                    'message' => $value->message ,
                    'filepath' => 'https://hre.netiapps.com/ticketImages/',
                    'filename' => $value->filename,
                    'date' => $value->created_at->toDateTimeString()];

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
                'data'=> ''
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

}
