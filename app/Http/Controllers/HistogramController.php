<?php

namespace App\Http\Controllers;

use App\Models\Histogram;
use App\Models\Histogram_billing_details;
use App\Models\HreDetail;
use App\Models\HistogramClientDetails;
use App\Models\HistogramArchitectDetails;
use App\Models\HistogramLandlordDetails;
use App\Models\VendorDetail;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\User;
use App\Models\FootPrint;
use App\Models\VendorHeadings;
use App\Models\HistogramHistory;
use Illuminate\Http\Request;
use App\Mail\HistogramMail;
use App\Jobs\GeneratePdf;
use App\Jobs\GenerateNewHistogramPdf;
use Auth;
use PDF;
use File;   
use Mail;
use DB;

class HistogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7) {
             $histogram = Histogram_billing_details::whereNull('pcn')->get();
        }
        else{
             $histogram = Histogram_billing_details::where('user_id' , Auth::user()->id)->whereNull('pcn')->get();
        }
       

        $data =Histogram_billing_details::whereNotNull('pcn')->orderByRaw("LENGTH(pcn) DESC")->orderBy('pcn', 'desc')->get(); 

        $search = '';
        $search2 = '';

        return view('histogram/list',compact('data','histogram','search','search2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headings  = VendorHeadings::get();
        return view('histogram/create',compact('headings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // print_r(json_encode($request->Input()) ); die();
        
        $billing = new Histogram_billing_details;
        $billing->billing_name=$request->billing_name;
        $billing->brand=$request->project_name;
        $billing->gst = $request->gst;
        $billing->project_name = $request->project_name;
        $billing->type_of_work = $request->type;
        $billing->location = $request->location;
        $billing->area = $request->area;
        $billing->city = $request->city;
        $billing->state = $request->state;
        $billing->pincode = $request->pincode;
        $billing->target_start_date = $request->target_start_date;
        $billing->target_end_date = $request->target_end_date;
        $billing->approved_holidays_no = $request->approved_holidays_no;
        $billing->holiday_dates = $request->holiday_dates;
        $billing->actual_start_date = $request->actual_start_date;
        $billing->actual_end_date = $request->actual_end_date;
        $billing->hold_days_no = $request->hold_days_no;
        $billing->hold_dates = $request->hold_dates;
        $billing->po_date = $request->po_date;
        $billing->po_number = $request->po_number;
        $billing->is_dlp_applicable = $request->is_dlp_applicable;
        $billing->dlp_days = $request->dlp_days;
        $billing->dlp_end_date = $request->dlp_end_date;
        $billing->user_id = Auth::user()->id;
        $billing->generalnotes = $request->generalnote;
        $billing->save();

        $billing_id = $billing->id ;

        if($billing_id != 0 || $billing_id != ''){

           

        if(isset($request->client)){

        foreach ($request->client as $key => $value) {
                
            HistogramClientDetails::create([
                'histogram_billing_id'=> $billing_id,
                'client_name' => $value['name'],
                'client_designation' => $value['designation'],
                'client_organisation' => $value['organisation'],
                'client_contact' => $value['contact'],
                'client_email' => $value['email']
                 ]);
            }
           } 


            if(isset($request->arch)){
                foreach ($request->arch as $key2 => $value2) {
            HistogramArchitectDetails::create([
                'histogram_billing_id'=> $billing_id,
                'arc_name' => $value2['name'],
                'arc_designation' => $value2['designation'],
                'arc_organisation' => $value2['organisation'],
                'arc_contact' => $value2['contact'],
                'arc_email' => $value2['email']
                 ]);
            }
            }
            

            if(isset($request->land)){
            foreach ($request->land as $key3 => $value3) {
            HistogramLandlordDetails::create([
                'histogram_billing_id'=> $billing_id,
                'land_name' => $value3['name'],
                'land_designation' => $value3['designation'],
                'land_organisation' => $value3['organisation'],
                'land_contact'=> $value3['contact'],
                'land_email' => $value3['email']
                 ]);
            }
           }

            if(isset($request->hre)){
               foreach ($request->hre as $key3 => $value3) {
                 HreDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'name' => $value3['name'],
                    'designation' => $value3['designation'],
                    'contact' => $value3['contact'],
                    'email'=> $value3['email'],
                    'start_date' => $value3['start'],
                    'end_date' => $value3['end']
                     ]);
            }

           }


          
            if(isset($request->vendor)){
                foreach ($request->vendor as $key4 => $value4) {
                VendorDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'department' => $value4['department'],
                    'company_name' => $value4['company'],
                    'contracter_name' => $value4['name'],
                    'contracter_mobile' => $value4['mobile'],
                    'supervisor_name'=> $value4['supervisor'],
                    'supervisor_mobile' => $value4['supr_mobile'],
                    'start_date' => $value4['start'],
                    'end_date' => $value4['end']
                     ]);
                }
            }


            $id = $billing_id ;

            $data = Histogram_billing_details::where('id' ,$id)->first();

            $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
            $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
            $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
            $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
            $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();
    
            $rand = date('d-m-Y').'_'.date('H-i');
            $filename = 'histogram_'.$rand.'.pdf';
          
            $empl = Employee::where('user_id',Auth::user()->id)->first();
            $empl_id = $empl->employee_id;
            $pcn  = $request->pcn ;
           // $empl_mail  = $empl->email ;
            $name = $data->user->name ;
            $alias = $data->user->roles->alias;
            $subject = "Submission of New Project Histogram Form (PH".$id.")";

            $emailarray = User::select('email')
                          ->whereIn('role_id',['1','2','3','4','5'])
                          ->where('status','Active')
                          ->get();

               foreach ($emailarray as $key => $value) {
                  $empl_mail[]=$value->email;
               }

            GenerateNewHistogramPdf::dispatch($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id ,$pcn ,$empl_mail ,$name , $alias , $subject);

            $histogram = Histogram_billing_details::where('id',$billing_id)->first();
            $history = HistogramHistory::create([
                    'pcn'=>'Not Alloted',
                    'histogram_id'=>$billing_id,
                    'user_id' => Auth::user()->id,
                    'submission_date' => date('Y-m-d H:i:s'), 
                    'submission_time' => date('Y-m-d H:i:s'),
                    'path' => 'histogram',
                    'filename' => $filename 
                ]);

            $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();

            $footprint = FootPrint::create([
                        'action' => 'PH'.$data->id.' - New Histogram created By - '.$empl->employee_id.' on '.$request->project_name,
                        'user_id' => Auth::user()->id,
                        'module' => 'Histogram',
                        'operation' => 'C'
                    ]);
              
           // print_r("lll"); die();  
             return redirect()->route('histogram');

            } 

           
            /*if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }

            $pdf = PDF::loadView('pdf/new_histogramPDF',compact('data','client','arch','land','hre','vendor' ));
        
            $savepdf = $pdf->save(public_path($filename));

            
            }

           
            $attachment = public_path($filename) ;

            $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();

            $subject = "New Histogram Created - ".$empl->employee_id." Project Name - ".$request->project_name;
           // $subject = "Hi";

            try {
                  Mail::to(Auth::user()->email)->send(new HistogramMail($subject , $attachment));
                 // Mail::to($emailid)->queue(new TicketsMail($ticketarray , $subject));
                } catch (\Exception $e) {
                    return $e->getMessage();
                   
                } 
                finally {
                    $footprint = FootPrint::create([
                        'action' => 'New Histogram created By - '.$empl->employee_id.' on '.$request->project_name,
                        'user_id' => Auth::user()->id,
                        'module' => 'Histogram',
                        'operation' => 'C'
                    ]);
              
                 // print_r($billing_id); die(); 
                  return redirect()->route('histogram');
               } */

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Histogram  $histogram
     * @return \Illuminate\Http\Response
     */
    public function show(Histogram $histogram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Histogram  $histogram
     * @return \Illuminate\Http\Response
     */

    public function edit_myform($id){
        $data = Histogram_billing_details::where('id' ,$id)->first();

        $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
        $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
        $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();
    
        $pcn = Pcn::where('status' , 'Active')->get(); 
         $headings  = VendorHeadings::get();

        //print_r(json_encode($client));die();
        return view('histogram/edit',compact('data','client','arch','land','hre','vendor','pcn' ,'id','headings'));
    }

     public function update_myform(Request $request)
    {
        
       // print_r(json_encode($request->Input())); die();

        $update =Histogram_billing_details::where('id',$request->histogram_id)->update([
            'billing_name'=>$request->billing_name,
            'project_name'=>$request->project_name,
            'type_of_work'=>$request->type,
            'gst'=> $request->gst,
            'location'=>$request->location,
            'area'=> $request->area,
            'city' => $request->city,
            'state'=> $request->state,
            'form_verified_by' => Auth::user()->id,
            'pcn_alloted_by' => Auth::user()->id,
            'target_start_date' =>  $request->target_start_date,
            'target_end_date' =>  $request->target_end_date,
            'approved_holidays_no' =>  $request->approved_holidays_no,
            'holiday_dates' =>  $request->holiday_dates,
            'actual_start_date' =>  $request->actual_start_date,
            'actual_end_date' =>  $request->actual_end_date,
            'hold_days_no' =>  $request->hold_days_no,
            'hold_dates' =>  $request->hold_dates,
            'po_date' =>  $request->po_date,
            'po_number' =>  $request->po_number,
            'is_dlp_applicable' =>  $request->is_dlp_applicable,
            'dlp_days' =>  $request->dlp_days,
            'dlp_end_date' =>  $request->dlp_end_date,
            'generalnotes' => $request->generalnote
        ]) ;

        $client = HistogramClientDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $hre = HreDetail::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $vendor = VendorDetail::where('histogram_billing_id' ,$request->histogram_id)->delete();

        $billing_id = $request->histogram_id ;

         if(isset($request->client)){

        foreach ($request->client as $key => $value) {
                
            HistogramClientDetails::create([
                'histogram_billing_id'=> $billing_id,
                'client_name' => $value['name'],
                'client_designation' => $value['designation'],
                'client_organisation' => $value['organisation'],
                'client_contact' => $value['contact'],
                'client_email' => $value['email']
                 ]);
            }
           } 


            if(isset($request->arch)){
                foreach ($request->arch as $key2 => $value2) {
            HistogramArchitectDetails::create([
                'histogram_billing_id'=> $billing_id,
                'arc_name' => $value2['name'],
                'arc_designation' => $value2['designation'],
                'arc_organisation' => $value2['organisation'],
                'arc_contact' => $value2['contact'],
                'arc_email' => $value2['email']
                 ]);
            }
            }
            

            if(isset($request->land)){
            foreach ($request->land as $key3 => $value3) {
            HistogramLandlordDetails::create([
                'histogram_billing_id'=> $billing_id,
                'land_name' => $value3['name'],
                'land_designation' => $value3['designation'],
                'land_organisation' => $value3['organisation'],
                'land_contact'=> $value3['contact'],
                'land_email' => $value3['email']
                 ]);
            }
           }

            if(isset($request->hre)){
               foreach ($request->hre as $key3 => $value3) {
                 HreDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'name' => $value3['name'],
                    'designation' => $value3['designation'],
                    'contact' => $value3['contact'],
                    'email'=> $value3['email'],
                    'start_date' => $value3['start'],
                    'end_date' => $value3['end']
                     ]);
            }

           }


          
            if(isset($request->vendor)){
                foreach ($request->vendor as $key4 => $value4) {
                VendorDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'department' => $value4['department'],
                    'company_name' => $value4['company'],
                    'contracter_name' => $value4['name'],
                    'contracter_mobile' => $value4['mobile'],
                    'supervisor_name'=> $value4['supervisor'],
                    'supervisor_mobile' => $value4['supr_mobile'],
                    'start_date' => $value4['start'],
                    'end_date' => $value4['end']
                     ]);
                }
            }

            $id = $billing_id ;

            $data = Histogram_billing_details::where('id' ,$id)->first();

            $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
            $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
            $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
            $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
            $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();

            $rand = date('d-m-Y').'_'.date('H-i');
            $filename = 'histogram_'.$rand.'.pdf';

            $empl = Employee::where('user_id',Auth::user()->id)->first();
            $empl_id = $empl->employee_id;
            $pcn  = $request->pcn ;
            $empl_mail  = $empl->email ;
            $name = $data->user->name ;
            $alias = $data->user->roles->alias;
            $subject = "Histogram Edited - PH".$data->id." - ".$empl->employee_id." Project Name - ".$request->project_name;

            GenerateNewHistogramPdf::dispatch($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id ,$pcn ,$empl_mail ,$name ,$alias , $subject);

            $histogram = Histogram_billing_details::where('id',$request->histogram_id)->first();
            $history = HistogramHistory::create([
                    'pcn'=>'Not Alloted',
                    'histogram_id'=>$billing_id,
                    'user_id' => Auth::user()->id,
                    'submission_date' => date('Y-m-d H:i:s'),
                    'submission_time' => date('Y-m-d H:i:s'),
                    'path' => 'histogram',
                    'filename' => $filename 
                ]);


                    $footprint = FootPrint::create([
                        'action' => 'PH'.$data->id.' - Histogram Edited - by '.$empl->employee_id.' on '.$request->project_name,
                        'user_id' => Auth::user()->id,
                        'module' => 'Histogram',
                        'operation' => 'U'
                   ]);
           
           
           /* $pdf = PDF::loadView('pdf/new_histogramPDF',compact('data','client','arch','land','hre','vendor' ));
        
            $savepdf = $pdf->save(public_path($filename));
           
            $attachment = public_path($filename) ;

            $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();

            $subject = "Histogram Edited - ".$empl->employee_id." Project Name - ".$request->project_name;
           // $subject = "Hi";

            try {
                  Mail::to(Auth::user()->email)->send(new HistogramMail($subject , $attachment));
                 // Mail::to($emailid)->queue(new TicketsMail($ticketarray , $subject));
                } catch (\Exception $e) {
                    return $e->getMessage();
                   
                } 
                finally {
                    $footprint = FootPrint::create([
                    'action' => 'Histogram Edited - by '.$empl->employee_id.' on '.$request->project_name,
                    'user_id' => Auth::user()->id,
                    'module' => 'Histogram',
                    'operation' => 'U'
                ]);

                return redirect()->route('histogram');

               } */

        return redirect()->route('histogram');
      

       
        
    }

    public function edit($id)
    {
        $data = Histogram_billing_details::where('id' ,$id)->first();

        $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
        $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
        $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();
    
        $pcn = Pcn::where('status' , 'Active')->get(); 
        

        //print_r(json_encode($client));die();
        return view('histogram/view_form',compact('data','client','arch','land','hre','vendor','pcn' ,'id',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Histogram  $histogram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $pcn_details= Pcn::where('pcn',$request->pcn)->first();
//print_r($request->Input()); die();

        $update =Histogram_billing_details::where('id',$request->histogram_id)->update([
            'pcn'=>$request->pcn,
            'billing_name'=>$pcn_details->client_name,
            'project_name'=>$pcn_details->brand,
            'type_of_work'=>$pcn_details->work,
            'gst'=> $pcn_details->gst,
            'location'=>$pcn_details->location,
            'area'=> $pcn_details->area,
            'city' => $pcn_details->city,
            'state'=> $pcn_details->state,
            'form_verified_by' => Auth::user()->id,
            'pcn_alloted_by' => Auth::user()->id,
            'target_start_date' =>  $request->target_start_date,
            'target_end_date' =>  $request->target_end_date,
            'approved_holidays_no' =>  $request->approved_holidays_no,
            'holiday_dates' =>  $request->holiday_dates,
            'actual_start_date' =>  $request->actual_start_date,
            'actual_end_date' =>  $request->actual_end_date,
            'hold_days_no' =>  $request->hold_days_no,
            'hold_dates' =>  $request->hold_dates,
            'po_date' =>  $request->po_date,
            'po_number' =>  $request->po_number,
            'is_dlp_applicable' =>  $request->is_dlp_applicable,
            'dlp_days' =>  $request->dlp_days,
            'dlp_end_date' =>  $request->dlp_end_date,
            'generalnotes' => $request->generalnote
        ]) ;
       
       if($update){
         
            $id = $request->histogram_id ;

            $data = Histogram_billing_details::where('id' ,$id)->first();

            $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
            $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
            $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
            $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
            $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();

           // print_r($data); die();

             //$rand = rand('111111111','999999999');
            $rand = date('d-m-Y').'_'.date('H-i');
            $filename = 'histogram_'.$rand.'.pdf';

            $empl = Employee::where('user_id',Auth::user()->id)->first();
            $empl_id = $empl->employee_id;
            $empli_name = $empl->name ; 
            $pcn  = $request->pcn ;
            $empl_mail  = $empl->email ;
            $name = $data->user->name ;
            $alias = $data->user->roles->alias;

           // print_r('email is '.$empl_mail); die();

            $subject = "Histogram Updated to ".$request->pcn." ".$pcn_details->billing_name ;

             $emailarray = User::select('email')
                         ->whereIn('role_id',['1','2','3','4','5','6','7','10','11'])
                         ->where('status','Active')
                         ->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
                 
               }

            GeneratePdf::dispatch($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id , $empli_name,$pcn ,$empl_mail ,$name , $alias , $subject , $emailid);

            $histogram = Histogram_billing_details::where('id',$request->histogram_id)->first();
            $history = HistogramHistory::create([
                    'pcn'=>$request->pcn,
                    'histogram_id'=>$request->histogram_id,
                    'user_id' => Auth::user()->id,
                    'submission_date' => date('Y-m-d H:i:s'),
                    'submission_time' => date('Y-m-d H:i:s'),
                    'path' => 'histogram',
                    'filename' => $filename 
                ]);

           
            $footprint = FootPrint::create([
                        'action' => 'PH'.$data->id.' - Histogram verified - '.$request->pcn,
                        'user_id' => Auth::user()->id,
                        'module' => 'Histogram',
                        'operation' => 'U'
                    ]);

            return redirect()->route('histogram');
       }

            
        
    }



    public function update_form($id){
        $data = Histogram_billing_details::where('id' ,$id)->first();

        $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
        $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
        $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();
        $headings  = VendorHeadings::get();
        
    //print_r(json_encode($client));die();
        return view('histogram/update_form',compact('data','client','arch','land','hre','vendor' ,'id','headings'));
        
    }

    public function view_history($id){
        $data = HistogramHistory::where('histogram_id', $id)->orderBy('id' , 'DESC')->get();
        $histogram = Histogram_billing_details::where('id' , $id)->first();


        return view('histogram/view_history',compact('data','histogram'));
    }

    public function update_histogram_details(Request $request){
       // print_r(json_encode($request->Input()));die(); 

        $billing_id=$request->histogram_id;

       // print_r($billing_id);die();

        

        $update = Histogram_billing_details::where('id',$billing_id)->update([
            'target_start_date' =>  $request->target_start_date,
            'target_end_date' =>  $request->target_end_date,
            'approved_holidays_no' =>  $request->approved_holidays_no,
            'holiday_dates' =>  $request->holiday_dates,
            'actual_start_date' =>  $request->actual_start_date,
            'actual_end_date' =>  $request->actual_end_date,
            'hold_days_no' =>  $request->hold_days_no,
            'hold_dates' =>  $request->hold_dates,
            'po_date' =>  $request->po_date,
            'po_number' =>  $request->po_number,
            'is_dlp_applicable' =>  $request->is_dlp_applicable,
            'dlp_days' =>  $request->dlp_days,
            'dlp_end_date' =>  $request->dlp_end_date,
            'generalnotes' => $request->generalnote
               ]);


        $client = HistogramClientDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $hre = HreDetail::where('histogram_billing_id' ,$request->histogram_id)->delete();
        $vendor = VendorDetail::where('histogram_billing_id' ,$request->histogram_id)->delete();       

        if(isset($request->client)){

        foreach ($request->client as $key => $value) {
                
            HistogramClientDetails::create([
                'histogram_billing_id'=> $billing_id,
                'client_name' => $value['name'],
                'client_designation' => $value['designation'],
                'client_organisation' => $value['organisation'],
                'client_contact' => $value['contact'],
                'client_email' => $value['email']
                 ]);
            }
           } 


            if(isset($request->arch)){
                foreach ($request->arch as $key2 => $value2) {
            HistogramArchitectDetails::create([
                'histogram_billing_id'=> $billing_id,
                'arc_name' => $value2['name'],
                'arc_designation' => $value2['designation'],
                'arc_organisation' => $value2['organisation'],
                'arc_contact' => $value2['contact'],
                'arc_email' => $value2['email']
                 ]);
            }
            }
            

            if(isset($request->land)){
            foreach ($request->land as $key3 => $value3) {
            HistogramLandlordDetails::create([
                'histogram_billing_id'=> $billing_id,
                'land_name' => $value3['name'],
                'land_designation' => $value3['designation'],
                'land_organisation' => $value3['organisation'],
                'land_contact'=> $value3['contact'],
                'land_email' => $value3['email']
                 ]);
            }
           }

            if(isset($request->hre)){
               foreach ($request->hre as $key3 => $value3) {
                 HreDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'name' => $value3['name'],
                    'designation' => $value3['designation'],
                    'contact' => $value3['contact'],
                    'email'=> $value3['email'],
                    'start_date' => $value3['start'],
                    'end_date' => $value3['end']
                     ]);
            }

           }


          
            if(isset($request->vendor)){
                foreach ($request->vendor as $key4 => $value4) {
                VendorDetail::create([
                    'histogram_billing_id'=> $billing_id,
                    'department' => $value4['department'],
                    'company_name' => $value4['company'],
                    'contracter_name' => $value4['name'],
                    'contracter_mobile' => $value4['mobile'],
                    'supervisor_name'=> $value4['supervisor'],
                    'supervisor_mobile' => $value4['supr_mobile'],
                    'start_date' => $value4['start'],
                    'end_date' => $value4['end']
                     ]);
                }
            }


            
            

            if(isset($request->client) OR isset($request->arch) OR isset($request->land) OR isset($request->hre)
             OR isset($request->vendor) ){

            $id = $billing_id ;

            $data = Histogram_billing_details::where('id' ,$id)->first();

            $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
            $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
            $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
            $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
            $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();

           // print_r($data); die();

             //$rand = rand('111111111','999999999');
            $rand = date('d-m-Y').'_'.date('H-i');
            $filename = 'histogram_'.$rand.'.pdf';

            $empl = Employee::where('user_id',Auth::user()->id)->first();
            $empl_id = $empl->employee_id;
            $pcn  = $request->pcn ;
            $empl_mail  = $empl->email ;
            $name = $empl->name ;
            $alias = $empl->user->roles->alias;
            $empli_name = $empl->name ; 

           // print_r('email is '.$empl_mail); die();
            $pcn_details= Pcn::where('pcn',$request->pcn)->first();

            $subject = "Histogram Updated to ".$request->pcn." ".$pcn_details->billing_name ;

             $emailarray = User::select('email')
                         ->whereIn('role_id',['1','2','3','4','5','6','7','10','11'])
                         ->where('status','Active')
                         ->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
                 
               }

            GeneratePdf::dispatch($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id ,$empli_name ,$pcn ,$empl_mail ,$name , $alias, $subject , $emailid);


                $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();
                $histogram = Histogram_billing_details::where('id',$request->histogram_id)->first();
                        $history = HistogramHistory::create([
                        'pcn'=>$request->pcn,
                        'histogram_id'=>$request->histogram_id,
                        'user_id' => Auth::user()->id,
                        'submission_date' => date('Y-m-d H:i:s'),
                        'submission_time' => date('Y-m-d H:i:s'),
                        'path' => 'histogram',
                        'filename' => $filename 
                    ]);

                $footprint = FootPrint::create([
                    'action' => 'PH'.$data->id.' - Histogram Updated By - '.$empl->employee_id.' on '.$data->pcn,
                    'user_id' => Auth::user()->id,
                    'module' => 'Histogram',
                    'operation' => 'U'
                ]);        

            }



            return redirect()->route('view_history',$billing_id);
            


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Histogram  $histogram
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->delete();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->delete();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->delete();
        $hre = HreDetail::where('histogram_billing_id' ,$id)->delete();
        $vendor = VendorDetail::where('histogram_billing_id' ,$id)->delete(); 
        $billing_details = Histogram_billing_details::where('id',$id)->delete();

        if($billing_details){
            return redirect()->back();
        }
    }

    public function search(Request $request){
        $search = $request->search ;
        $search2 = $request->search2 ;

        if($search == '' && $search2 == ''){
            // print_r("lll"); die();
            return redirect()->route('histogram');
        }
        elseif($search == '' && $search2 != ''){
            // print_r("222"); die();
             $data =Histogram_billing_details::whereNotNull('pcn')->orderByRaw("LENGTH(pcn) DESC")->orderBy('pcn', 'desc')->get();

             $histogram =Histogram_billing_details::whereNull('pcn')
              ->where(function($query)use($search2){
                    $query->where('billing_name','LIKE','%'.$search2.'%');
                    $query->orWhere('location','LIKE','%'.$search2.'%');
                    $query->orWhere('project_name','LIKE','%'.$search2.'%');
                    $query->orWhere('area','LIKE','%'.$search2.'%');
                    $query->orWhere('city','LIKE','%'.$search2.'%');
                    $query->orWhere('state','LIKE','%'.$search2.'%');
                    $query->orWhere('id','LIKE','%'.$search2.'%');
                 })
            
            ->get(); 


        }
        elseif($search != '' && $search2 == ''){
            //print_r("333"); die();
            $histogram = Histogram_billing_details::whereNull('pcn')->get();

            $data =Histogram_billing_details::whereNotNull('pcn')
            ->where(function($query)use($search){
                    $query->where('pcn','LIKE','%'.$search.'%');
                    $query->orWhere('pcn','LIKE','%'.$search.'%');
                    $query->orWhere('billing_name','LIKE','%'.$search.'%');
                    $query->orWhere('location','LIKE','%'.$search.'%');
                    $query->orWhere('project_name','LIKE','%'.$search.'%');
                    $query->orWhere('area','LIKE','%'.$search.'%');
                    $query->orWhere('city','LIKE','%'.$search.'%');
                    $query->orWhere('state','LIKE','%'.$search.'%');
                    $query->orWhere('id','LIKE','%'.$search.'%');
                 })
            ->orderByRaw("LENGTH(pcn) DESC")
            ->orderBy('pcn', 'desc')
            ->get();   
        }
        else{
           print_r("444"); die();
        }
        return view('histogram/list',compact('data','histogram','search','search2'));
    }

   

    public function delete_history($id , $histogram_id){
       
       $check = HistogramHistory::where('histogram_id',$histogram_id)->count();

       if($check > 1){
        $check = Histogram_billing_details::where('id',$histogram_id)->first();
           $data = HistogramHistory::where('id',$id)->first();
           $path = $data->path.'/'.$data->filename ;

            if (File::exists($path)) {
                    
                    unlink($path);
                }

            $delete = HistogramHistory::where('id',$id)->delete();  
            
            if($delete){
                $footprint = FootPrint::create([
                    'action' => 'PH'.$check->id.' - Histogram history deleted - '.$data->pcn,
                    'user_id' => Auth::user()->id,
                    'module' => 'Histogram',
                    'operation' => 'D'
                ]);
                 return redirect()->back()->withMessage('Histogram History Successfully Deleted');
            } 
            else {
                 return redirect()->back()->withMessage('Could not be deleted , Please contact Super Admin.');
            }

       }else{
        return redirect()->back()->withMessage('Can not be deleted .There must be at lease one document for review purpose');
       }

       // print_r($check); die();

    }


    public function get_pcn_data(Request $request){
        $data = DB::table('pcns')
            ->select(
                    DB::raw("CONCAT(pcn) AS value"),
                    'client_name',
                    'pcn',
                    'brand',
                    'location',
                    'area',
                    'city',
                    'state',
                    'pincode',
                    'status',
                    'gst',
                    'work'
                )
                    ->where('pcn', 'LIKE', '%'. $request->get('search'). '%')
                    ->where('status' , 'Active')
                    ->get();            
    
        return response()->json($data);
    }
}
