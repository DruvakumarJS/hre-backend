<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;
use PDF;
use Auth;

use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $filter="all";

      if($user->role == 'admin' || $user->role == 'manager' || $user->role == 'finance'){
         $tickets = Ticket::orderby('id' , 'DESC')->paginate(10);
      }
      else {
         $tickets = Ticket::where('creator' , $user->id)->orWhere('assigned_to', $user->id )->orderby('id' , 'DESC')->paginate(10);
      }
        
         return view('ticket/list' ,  compact('tickets','filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $supervisor = Employee::where('role','supervisor')->get();
      $employee = User::select('id' , 'name' , 'role_id')->get();
      $pcn = Pcn::where('status', 'Active')->get();
      $category=Category::get(); 
        return view('ticket/create', compact('employee', 'pcn' , 'category'));
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
            'category' => $request->category,
            'issue' => $request->issue,
            'creator' => $request->owner ,
            'priority' => $request->priority,
            'filename' => $fileName,
            'status' => 'Created'
        ]);

        if($Insert){
            return redirect()->route('tickets');
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

         if($file = $request->hasFile('image')) {
             $fileName = '';
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

           

             $update = Ticket::where('id',$request->id)->update([
                    'filename' => $fileName
                     ]);
            
         }
         

        if(($request->status) == 'Rejected' || ($request->status) == 'Created' ){
           
           
             $update = Ticket::where('id',$request->id)->update([
                    'issue' => $request->issue ,
                    'status' => $request->status,
                    'comments' => $request->comment,
                    'assigner' => $request->assigner
                     ]);
        }

        else if($request->status == 'Re-Opened'){
          
           
             $update = Ticket::where('id',$request->id)->update([
                    'issue' => $request->issue ,
                    'status' => 'Pending',
                    'comments' => $request->comment,
                    'assigned_to' => $request->user_id,
                    'priority' => $request->priority,
                    'tat' => $request->tat,
                    'assigner' => $request->assigner,
                    'reopened' => '1'
                     ]);

              $ticket = Ticket::where('id',$request->id)->first();

             
        }
        else {
           
             $update = Ticket::where('id',$request->id)->update([
                    'issue' => $request->issue ,
                    'status' => $request->status,
                    'comments' => $request->comment,
                    'assigned_to' => $request->user_id,
                    'assigner' => $request->assigner,
                    'priority' => $request->priority,
                    'tat' => $request->tat
                     ]);

             $ticket = Ticket::where('id',$request->id)->first();
             
             if($request->status == 'Pending'){
                   $msg = 'Ticket no '.$ticket->ticket_no .' is assigned to you';
             }
             else if($request->status == 'Completed'){
                 $msg = 'Ticket no '.$ticket->ticket_no .' is Completed and closed';
             }
            

        }
/*
        if($request->status == 'Re-Opened')
        {
             $update = Ticket::where('id',$request->id)->update(
            'issue' => $request->issue ,
            'owner' => $request->owner,
            'assigned_to' => $request->user_id,
            'status' => 'Pending',
            'reopened'=> '1']);

             $t_data = Ticket::where('id',$request->id)->first();

             $conversation = TicketConversation::create([
                'ticket_id' => $request->id ,
                'ticket_no' => $t_data->ticket_no ,
                'sender' => $request->owner ,
                'recipient' => $request->user_id,
                'message' => "Ticket is Reopened ",
                'status' => 'Pending',
                 'filename' => '' 
               
            ]);

        }
        else{
             $update = Ticket::where('id',$request->id)->update([
            'indent_no' => $request->indent_no,
            'issue' => $request->issue ,
            'assigned_to' => $request->user_id,
            'status' => $request->status]);
        }*/

        if(isset($request->checkbox)){

            $t_data = Ticket::where('id',$request->id)->first();

        $data = [
            'ticket_no' => $t_data->ticket_no,
            'Subject' => $t_data->subject,
            'issue' =>  $t_data->issue,
            'status' => $t_data->status,
            'created' =>$t_data->created_at,

            'date' => date('m/d/Y')
        ];

        /* $filename = 'hre1.pdf';
          
         $pdf = PDF::loadView('pdf.ticket_invoice', $data);
         return $pdf->download($filename);
         
        }*/

      }

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
        $filter = $request->filter ;
       // print_r($filter); die();

        if(empty($request->filter)){
          return redirect()->route('tickets');
        }
        else if($request->filter == '0'){
            $tickets = Ticket::orderby('id' , 'DESC')->paginate();
            return view('ticket/list' ,  compact('tickets','filter'));
        }
         else if($request->filter == 'Reopend'){
            $tickets = Ticket::where('reopened', '1')->orderby('id' , 'DESC')->paginate();
            return view('ticket/list' ,  compact('tickets','filter'));
        }
        else {
            $tickets = Ticket::where('creator' , $request->filter)->orWhere('status',$request->filter)->orderby('id' , 'DESC')->paginate();
            return view('ticket/list' ,  compact('tickets','filter'));
        }
    }
}
