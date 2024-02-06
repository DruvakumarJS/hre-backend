<?php

namespace App\Http\Controllers;

use App\Models\TicketConversation;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\FootPrint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\TicketConversationMail;
use App\Mail\TicketDetailsMail;
use App\Jobs\SendTicketUpdatesEmail;

use Mail;
use Auth ;

class TicketConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id)
    {
        $ticket = Ticket::where('ticket_no', $id)->first();
        $conversation = TicketConversation::where('ticket_id', $ticket->id)->get();
        $employee = User::select('id' , 'name' , 'role_id')->get();
        $pcn_data = Pcn::where('pcn',$ticket->pcn)->first();
        return view('ticket/details' , compact('id' , 'ticket' , 'conversation' , 'employee' , 'pcn_data'));
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
                'sender' => $request->sender ,
                'recipient' => $request->recipient,
                'status' => 'pending',
                'filename' => $fileName]);

            if($conversation){
                $update = Ticket::where('id',$request->ticket_id)->update(['comments' => $request->message]);
                
                $sender = Employee::where('user_id',$request->sender)->first();
                $recipient = Employee::where('user_id',$request->recipient)->first();
                $pcndata = Pcn::where('pcn',$Ticket->pcn)->first();

                $subject = "New message : " .$Ticket->ticket_no." - ".$Ticket->category ." - ".$Ticket->pcn." - ".$pcndata->brand  ;

                $body = "You have a new message from ".$sender->name." regarding ticket no.".$request->ticket_no;

                $ticketarray = ['ticket_no'=>$Ticket->ticket_no ,'sender' => $sender->name , 'assigned_to' => $recipient->name." - ".$recipient->employee_id , 'body' => $body ,'action' => 'reply'];


                $emailarray=User::where('id',$request->recipient)->orWhereIn('role_id',['1','2'])->get();

                    foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                     
                    }
                   // print_r($emailid); die();
               SendTicketUpdatesEmail::dispatch($ticketarray , $subject , $emailid) ;   

               $footprint = FootPrint::create([
                            'action' => 'Message from '.$sender->employee_id .' - '. $Ticket->ticket_no,
                            'user_id' => Auth::user()->id,
                            'module' => 'Ticket',
                            'operation' => 'U'
                        ]);
                    
                     return redirect()->route('ticket-details',$request->ticket_no)->withMessage('Message sent');         
                 

                
            }

        }
        else {
            return redirect()->route('ticket-details',$request->ticket_no)->withMessage('Ticket is closed . You cannot communicate to this ticket No .');
        }
    }

    public function download_conversation_ticket($id){

       
        $data = TicketConversation::select('filename')->where('id', $id)->first();

        $zip = new \ZipArchive();
        $fileName = 'zipFile.zip';
        $destinationPath = public_path($fileName);

        if(file_exists($destinationPath)){
           
            unlink($destinationPath);
        }

      
        $downloads = explode(',', $data->filename);


        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
           //$files = File::files(public_path('myFiles'));
            foreach ($downloads as $key => $value){
                $relativeName = basename($value);
                $path = 'ticketimages/'.$relativeName;
                $zip->addFile($path);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName));


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
