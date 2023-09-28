<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\TicketDepartment;
use App\Models\User;
use App\Models\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Mail\TicketsMail;
use App\Mail\TicketDetailsMail;
use PDF;
use Auth;
use ZipArchive;
use Mail ;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $tickets=array();

      if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '5'){
         $tickets = Ticket::orderby('id' , 'DESC')->get();
      }
      else { 
          $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)->groupBy('ticket_id')->get();

          foreach ($ticket_convers as $key => $value) {
            $ids[]=$value->ticket_id;

          }

        
       if(sizeof($ticket_convers) > 0){
       
        $tickets = Ticket::where(function($query){
            $query->where('status','!=','Resolved');
        })
        ->whereIn('id', $ids)->orWhere('creator', Auth::user()->id)
        
        ->orderby('id' , 'DESC')->get();
       }
       else{
           $tickets = Ticket::where('creator', Auth::user()->id)->orWhere('assigned_to', Auth::user()->id)->orderby('id' , 'DESC')->get();
       }

       // print_r(json_encode($tickets)); die();
      }
     // $tickets = $this->paginate($tickets);

         return view('ticket/list' ,  compact('tickets','filter'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
      $category=TicketDepartment::get(); 
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

         if($file = $request->hasFile('file')) {

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
               $fileName = basename($_FILES['file']['name'][$key]); 
                $temp = explode(".", $fileName);
                 
                  $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/ticketimages/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
             
                 
            }
          
          }

          $imageNames = implode(',', $imagearray);
          //$revertNames = explode(',', $imageNames);

        $Insert = Ticket::create([
            'ticket_no'=> $ticket_no,
            'pcn' => $request->pcn,
            'category' => $request->category,
            'issue' => $request->issue,
            'creator' => $request->owner ,
            'priority' => $request->priority,
            'filename' => $imageNames,
            'status' => 'Created'
        ]);

        if($Insert){
          
          $empl = Employee::where('user_id',Auth::user()->id)->first(); 

          $subject = "New Ticket : " .$ticket_no." - ".$request->category ." - ".$request->pcn;

          $ticketarray = [
             'ticket_no'=> $ticket_no,
             'pcn' => $request->pcn,
             'creator' => $empl->name ,
             'category' => $request->category,
             'issue' => $request->issue,
             'priority' => $request->priority,
             ];

           
         $departemnt = TicketDepartment::where('department', $request->category)->first();
         $recipients = $departemnt->roles;

         $array = explode(',', $recipients);

         //print_r($array); die();

         // $emailarray = User::select('email')->where('role_id','1')->orWhere('role_id','2')->get();
          $emailarray = User::select('email')->whereIn('role_id',$array)->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
                 
               }

         
                try {
                      Mail::to($emailid)->send(new TicketsMail($ticketarray , $subject));
                     // Mail::to($emailid)->queue(new TicketsMail($ticketarray , $subject));
                    } catch (\Exception $e) {
                        return $e->getMessage();
                       
                    } 
                    finally {
                      $message = $ticket_no;
                     return response()->json($message);
                   }             
                 }


        }
        else {
            // return redirect()->route('generate-ticket')->withInput()->withmessage('PCN does not exist');
             $message = "PCN does not exist";
             return response()->json($message);
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

         if(($request->status) == 'Created' && $request->hasFile('image')){

             $update = Ticket::where('id',$request->id)->update([
                    'issue' => $request->issue ,
                    'status' => $request->status,
                    'comments' => $request->comment,
                    'assigner' => $request->assigner,
                    'filename' => $imageNames,
                     ]);
         }
         

        else if(($request->status) == 'Rejected' || ($request->status) == 'Created' ){
           
           
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
                    'status' => 'Pending/Ongoing',
                    'comments' => $request->comment,
                    'assigned_to' => $request->user_id,
                    'priority' => $request->priority,
                    'tat' => $request->tat,
                    'assigner' => $request->assigner,
                    'reopened' => '1'
                     ]);



              $ticket = Ticket::where('id',$request->id)->first();

               $conversation = TicketConversation::create([
                'ticket_id' => $ticket->id ,
                'ticket_no' => $ticket->ticket_no ,
                'message' => $request->comment ,
                'sender' => auth::user()->id ,
                'recipient' => $request->user_id,
                'status' => 'Pending/Ongoing',
                'filename' => $imageNames]);

             
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
             
             if($request->status == 'Pending/Ongoing'){

                   $msg = 'Ticket no '.$ticket->ticket_no .' is assigned to you';

                   $conversation = TicketConversation::create([
                        'ticket_id' => $ticket->id ,
                        'ticket_no' => $ticket->ticket_no ,
                        'message' => $request->comment ,
                        'sender' => $request->assigner ,
                        'recipient' => $request->user_id,
                        'status' => 'pending',
                        'filename' => $imageNames]);
                   if($conversation){

                 $recipient_detail = Employee::where('user_id',$request->user_id)->first();
                 $creator_detail = Employee::where('user_id',$ticket->creator)->first();
                 $assigner_detail = Employee::where('user_id',Auth::user()->id)->first();  

                  $subject = "Ticket verified : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn . " - ".$assigner_detail->employee_id ;

                  $body = "The Ticket No. ".$ticket->ticket_no." is verified by ".$assigner_detail->name."-".$assigner_detail->employee_id." and is assigned to ".$recipient_detail->name ."-".$recipient_detail->employee_id." .The TAT is set to ".$request->tat." .";

                 // print_r(json_encode($recipient_detail)); die();
                  
                  $ticketarray = [
                     'ticket_no'=> $ticket->ticket_no,
                     'assigned_to' => $recipient_detail->name ."-".$recipient_detail->employee_id,
                     'tat' =>$request->tat,
                     'comments' =>$request->comment
                     ];

                  $emailarray = User::select('email')->where('id',$request->user_id)->orWhere('id',$ticket->creator)->get();

                       foreach ($emailarray as $key => $value) {
                          $emailid[]=$value->email;
                       }

                 // Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));

                    try {
                      Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));
                    } catch (\Exception $e) {
                        return $e->getMessage();
                       
                    } 
                    finally {
                     
                       return redirect()->route('tickets');
                    }     

                   }
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
       
        if($filter == 'Pending'){$filter = 'Pending/Ongoing';}

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
            $tickets = Ticket::where('creator' , $request->filter)->orWhere('status',$filter)->orderby('id' , 'DESC')->get();
            return view('ticket/list' ,  compact('tickets','filter'));
        }
    }

    public function modify_ticket(Request $request){

        $ticket = Ticket::where('id',$request->ticket_id)->first();
        //print_r($request->Input()); die();
        $fileName="";
        if($request->action == 'Completed'){
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
                'recipient' => $ticket->creator,
                'status' => 'pending',
                'filename' => $fileName]);

             $subject = "Ticket Completed : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn;

              $body = "The Ticket No. ".$request->ticket_no." is Completed ";
              $ticketarray = ['ticket_no' => $request->ticket_no ];

              $emailarray = User::select('email')->where('id',$ticket->creator)->orWhere('role_id','2')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

             // Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));

        }
        else if($request->action == 'Resolved'){
            $conversation = TicketConversation::create([
                        'ticket_id' => $ticket->id ,
                        'ticket_no' => $ticket->ticket_no ,
                        'message' => 'This ticket is Resolved' ,
                        'sender' => Auth::user()->id ,
                        'recipient' => $ticket->creator,
                        ]);  

              $subject = "Ticket Resolved : " .$ticket->ticket_no." - ".$ticket->category ." - ".$ticket->pcn;

              $body = "The Ticket No. ".$request->ticket_no." is Resolved ";
              $ticketarray = ['ticket_no' => $request->ticket_no ];

              $emailarray = User::select('email')->orWhere('role_id','1')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

              //Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));                

        }

        $updateticket = Ticket::where('id',$ticket->id)->update([
            'status' => $request->action]);

        try {
          Mail::to($emailid)->send(new TicketDetailsMail($ticketarray , $subject , $body));    
        } catch (\Exception $e) {
            return $e->getMessage();
           
        } 
        finally {
         
          return redirect()->back();
        }     
      
        
    }

    public function download_ticket($id){

        $data = Ticket::select('filename')->where('id', $id)->first();

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

    public function search(Request $request){
        $user = Auth::user();
        $filter=$request->filter;
        $search = $request->search ;

        if($search == ''){
            return redirect()->route('tickets');
        }


      if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '5'){
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
       
          $ticket_convers=TicketConversation::select('ticket_id')->where('recipient', Auth::user()->id)
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
                 ->where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
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
           $tickets = Ticket::where(function($query){
                    $query->where('creator' , Auth::user()->id);
                    $query->orWhere('assigned_to' ,Auth::user()->id);
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
   //die();
      // $tickets = Ticket::orderby('id' , 'DESC')->paginate(10);
        
         return view('ticket/list' ,  compact('tickets','filter'));
    }

    public function departments(){
        $data = TicketDepartment::orderBy('id', 'DESC')->get();
        $roles = Roles::get();

        return view('ticket/departments', compact('data','roles'));

    }

    public function create_department(Request $request){
      // print_r($request->Input()); die();

        $roleids= explode(',', rtrim($request->roleids, ',')); 
        $names=array();

        foreach ($roleids as $value) {
           $role = Roles::where('id',$value)->first();
           array_push($names, $role->alias);

           //print_r(json_encode($alias)); 
        }
        
        $rolenames = implode(',', $names);
       // print_r($rolenames); die();
       
        $insert =TicketDepartment::create(['department' => $request->name , 'description' => $request->desc , 'roles' =>$request->roleids , 'role_alias' => $rolenames]);

        if($insert){
            return redirect()->route('department_master');
        }

    }

    public function update_department(Request $request , $id){
       // print_r($request->Input()); 

        $input = $request->all();
        $roleids= $input['cat']; 
        $names=array();
        $ids=array();

        foreach ($roleids as $value) {
           $role = Roles::where('id',$value)->first();
           array_push($names, $role->alias);
           array_push($ids, $role->id);

           //print_r(json_encode($alias)); 
        }
        
        $rolenames = implode(',', $names);
        $role_ids = implode(',', $ids);
       // print_r($rolenames); die();
       
        $insert =TicketDepartment::where('id',$id)->update(['department' => $request->name , 'description' => $request->desc , 'roles' =>$role_ids , 'role_alias' => $rolenames]);

        if($insert){
            return redirect()->route('department_master');
        }
    }

    public function delete_department($id){
        $destroy = TicketDepartment::where('id', $id)->delete();

        if($destroy){
             return redirect()->route('department_master');
        }
    }
}
