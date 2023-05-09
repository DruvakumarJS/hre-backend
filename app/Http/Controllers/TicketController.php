<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tickets = Ticket::orderby('id' , 'DESC')->paginate(10);
         return view('ticket/list' ,  compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $supervisor = Employee::where('role','supervisor')->get();
      $employee = User::select('id' , 'name' , 'role_id')->where('role_id', '!=' , '1')->get();
        return view('ticket/create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->Input());die();
      
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
            'owner' => $request->owner ,
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
                'sender' => $request->owner ,
                'recipient' => $request->user_id,
                'message' => $request->issue ,
                'status' => 'Pending',
                'filename' => $fileName 
            ]);

            if($conversation){

            return redirect()->route('tickets');
            }
            else{
                Ticket::where('ticket_id' ,$ticket_id)->delete();
                return redirect()->route('generate-ticket')->withInput()->withmessage('Could not create ticket');
            }
        }

        }
        else {
             return redirect()->route('generate-ticket')->withInput()->withmessage('PCN does not exist');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tickets = Ticket::where('ticket_no', $id)->first();
        $supervisor = User::get();
        return view('ticket/edit', compact('tickets' , 'supervisor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // print_r($request->Input());die();

       $update = Ticket::where('id',$request->id)->update([
            'indent_no' => $request->indent_no,
            'issue' => $request->issue ,
            'assigned_to' => $request->user_id,
            'status' => $request->status]);

       return redirect()->route('tickets');
    }

    public function ticket_details($id){
        $ticket = Ticket::where('ticket_no', $id)->first();
        $conversation = TicketConversation::where('ticket_id', $id)->get();
        return view('ticket/details' , compact('id' , 'ticket' , 'conversation'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function filter(Request $request)
    {
       // print_r($request->Input());
        if(empty($request->filter)){
          return redirect()->route('tickets');
        }
        else if($request->filter == '0'){
            $tickets = Ticket::orderby('id' , 'DESC')->paginate();
            return view('ticket/list' ,  compact('tickets'));
        }
        else {
            $tickets = Ticket::where('assigned_to' , $request->filter)->orWhere('status',$request->filter)->orderby('id' , 'DESC')->paginate();
            return view('ticket/list' ,  compact('tickets'));
        }
    }
}
