<?php

namespace App\Http\Controllers;

use App\Models\TicketConversation;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function index($id)
    {
        $ticket = Ticket::where('ticket_no', $id)->first();
        $conversation = TicketConversation::where('ticket_id', $ticket->id)->get();
        $employee = User::select('id' , 'name' , 'role_id')->where('role_id', '!=' , '1')->get();
        return view('ticket/details' , compact('id' , 'ticket' , 'conversation' , 'employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // print_r($request->Input());die();

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
                'sender' => $request->sender ,
                'recipient' => $request->recipient,
                'status' => 'pending',
                'filename' => $fileName]);

            if($conversation){
                return redirect()->route('ticket-details',$request->ticket_no)->withMessage('Message sent');
            }

        }
        else {
            return redirect()->route('ticket-details',$request->ticket_no)->withMessage('Ticket is closed . You cannot communicate to this ticket No .');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function show(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketConversation $ticketConversation)
    {
        //
    }
}
