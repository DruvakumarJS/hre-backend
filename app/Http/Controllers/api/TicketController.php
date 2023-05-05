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

     	if(Ticket::where('assigned_to' , $request->user_id)->exists()){

     		$tickets = Ticket::where('assigned_to' , $request->user_id)->get();

            foreach ($tickets as $key => $value) {
            	$ticketarray[]=[
            		'ticket_id'=> $value->id ,
            		'ticket_no' => $value->ticket_no ,
            		'pcn' => $value->pcn ,
            		'subject' => $value->subject ,
            		'message' => $value->issue,
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
      $fileName = '';
         if($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
        }

         return response()->json([
                'status' => 1 ,
                'message' => $fileName
             ]);

      //  print_r($fileName);die();

     	/*if(isset($request->user_id) && isset($request->pcn) && isset($request->subject) && isset($request->issue))
     	{

     	if(Pcn::where('pcn', $request->pcn)->exists())
        {
            if(Ticket::exists()){
            $tickets = Ticket::select('ticket_no')->orderby('id' , 'DESC')->first();

            $arr = explode("TN00", $tickets->ticket_no);
           // print_r($arr);die();
            $ticket_no = "TN00".++$arr[1];
        }
        else {
            $ticket_no ="TN001";
        }

        $Insert = Ticket::create([
            'ticket_no'=> $ticket_no,
            'pcn' => $request->pcn,
            'indent_no' => $request->indent_no,
            'subject' => $request->subject,
            'issue' => $request->issue ,
            'assigned_to' => $request->user_id,
            'owner' => $request->user_id ,
            'status' => 'Pending'
        ]);

        if($Insert){
            $t_data = Ticket::where('ticket_no' ,$ticket_no)->first();
            $fileName = '';


            if($file = $request->hasFile('image')) {
             
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            
           // $newfilename = round(microtime(true)) . '.' . end($temp);

            if(TicketConversation::exists()){
                 $conversation_id = TicketConversation::select('id')->orderBy('id', 'DESC')->first();
                 $temp = explode(".", $file->getClientOriginalName());
                 $fileName=$ticket_no .'_'.++$conversation_id->id. '.' . end($temp);
            }
           
            $destinationPath = public_path().'/ticketimages' ;
            $file->move($destinationPath,$fileName);
            
           }

            $conversation = TicketConversation::create([
                'ticket_id' => $t_data->id ,
                'ticket_no' => $ticket_no ,
                'sender' => $request->user_id ,
                'recipient' => $request->recipient,
                'message' => $request->issue ,
                'status' => 'Pending',
                'filename' => $fileName 
            ]);

            if($conversation){   
           
            return response()->json([
             	'status' => 1 ,
             	'message' => 'Ticket Created'
             ]);

            }
            else{
                Ticket::where('ticket_id' ,$ticket_id)->delete();
               
              return response()->json([
             	'status' => 0 ,
             	'message' => 'Could not create ticket'
             ]);

            }
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

    }*/
     	 

   }




   function conversation(Request $request){

	   if(isset($request->user_id) && isset($request->ticket_id) && isset($request->ticket_no) && isset($request->message) && isset($request->recipient) ){

	   	$Ticket = Ticket::select('status')->where('ticket_no',$request->ticket_no)->first();
        $fileName = '';
        if($Ticket->status == 'Pending'){

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

            foreach ($conversation as $key => $value) {
                $data[]=[
                    'sender' => $value->mailsender->name ,
                    'recipient' => $value->mailrecipient->name ,
                    'message' => $value->message ,
                    'filepath' => 'https://hre.netiapps.com/ticketImages/',
                    'filename' => $value->filename,
                    'date' => $value->created_at->toDateTimeString()];
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

}
