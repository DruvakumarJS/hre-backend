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
use App\Models\HistogramHistory;
use Illuminate\Http\Request;
use App\Mail\HistogramMail;
use Auth;
use PDF;
use File;   
use Mail;

class HistogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histogram = Histogram_billing_details::whereNull('pcn')->get();

        $data =Histogram_billing_details::whereNotNull('pcn')->get(); 

        $search = '';

        return view('histogram/list',compact('data','histogram','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('histogram/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // print_r(json_encode($request->Input())); die();

        $billing = new Histogram_billing_details;
        $billing->billing_name=$request->billing_name;
        $billing->brand=$request->brand;
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
        $billing->save();

        $billing_id = $billing->id ;

        if($billing_id != 0 || $billing_id != ''){

            /*foreach ($request->client as $key => $value) {
                
            HistogramClientDetails::create([
                'histogram_billing_id'=> $billing_id,
                'client_name' => $value['name'],
                'client_designation' => $value['designation'],
                'client_organisation' => $value['organisation'],
                'client_contact' => $value['contact'],
                'client_email' => $value['email']
                 ]);
            }

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

            foreach ($request->hre as $key5 => $value5) {
            HreDetail::create([
                'histogram_billing_id'=> $billing_id,
                'name' => $value5['name'],
                'designation' => $value5['designation'],
                'contact' => $value5['contact'],
                'email'=> $value5['email'],
                'start_date' => $value5['start'],
                'end_date' => $value5['end']
                 ]);
            }

            
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
            }*/

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
    
           
                $filename = 'histogram.pdf';
                $path = 'histogram' ;
               
                if (file_exists(public_path().'/'.$path)) {
                  
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
              Mail::to($empl->email)->send(new HistogramMail($subject , $attachment));
             // Mail::to($emailid)->queue(new TicketsMail($ticketarray , $subject));
            } catch (\Exception $e) {
                return $e->getMessage();
               
            } 
            finally {
                /*$footprint = FootPrint::create([
                    'action' => 'New Ticket created - '.$ticket_no,
                    'user_id' => Auth::user()->id,
                    'module' => 'Ticket',
                    'operation' => 'C'
                ]);*/
          
             // print_r($billing_id); die(); 
              return redirect()->route('histogram');
           } 

       
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
        return view('histogram/view_form',compact('data','client','arch','land','hre','vendor','pcn' ,'id'));
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
//print_r($pcn_details->brand); die();

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
            'dlp_end_date' =>  $request->dlp_end_date
        ]) ;
       
       /*if($update){
        $histogram = Histogram_billing_details::where('id',$request->histogram_id)->first();
        $history = HistogramHistory::create([
            'pcn'=>$request->pcn,
            'histogram_id'=>$request->histogram_id,
            'user_id' => $histogram->user_id,
            'submission_date' => $histogram->created_at,
            'submission_time' => $histogram->created_at
        ]);
       }*/

        return redirect()->route('histogram');
        
    }

    public function update_form($id){
        $data = Histogram_billing_details::where('id' ,$id)->first();

        $client = HistogramClientDetails::where('histogram_billing_id' ,$id)->get();
        $arch = HistogramArchitectDetails::where('histogram_billing_id' ,$id)->get();
        $land = HistogramLandlordDetails::where('histogram_billing_id' ,$id)->get();
        $hre = HreDetail::where('histogram_billing_id' ,$id)->get();
        $vendor = VendorDetail::where('histogram_billing_id' ,$id)->get();
    //print_r(json_encode($client));die();
        return view('histogram/update_form',compact('data','client','arch','land','hre','vendor' ,'id'));
        
    }

    public function view_history($id){
        $data = HistogramHistory::where('histogram_id', $id)->get();

        return view('histogram/view_history',compact('data'));
    }

    public function update_histogram_details(Request $request){
        //print_r(json_encode($request->Input()));die(); 

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
            'dlp_end_date' =>  $request->dlp_end_date
               ]);


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
    
           
               $rand = date('d-m-Y').'_'.date('H-i');
              
                $filename = 'histogram_'.$rand.'.pdf';
                // $filename = 'histogram.pdf';
                $path = 'histogram' ;
               
                if (file_exists(public_path().'/'.$path)) {
                  
                } else {
                   
                    File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
                }

                $pdf = PDF::loadView('pdf/histogramPDF',compact('data','client','arch','land','hre','vendor' ));
            
                $savepdf = $pdf->save(public_path('histogram').'/'.$filename);

                if($savepdf){
                $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();

                $subject = "Histogram Updated - ".$empl->employee_id." PCN - ".$data->pcn;

                $attachment = public_path($path.'/'.$filename) ;

                     try {
                          Mail::to($empl->email)->send(new HistogramMail($subject , $attachment));
                         // Mail::to($emailid)->queue(new TicketsMail($ticketarray , $subject));
                        } catch (\Exception $e) {
                            return $e->getMessage();
                           
                        } 
           
                  }


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

            }



            return redirect()->route('view_history',$billing_id);
            


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Histogram  $histogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Histogram $histogram)
    {
        //
    }

    public function search(Request $request){
        $search = $request->search ;

        if($search == ''){
            return redirect()->route('histogram');
        }
        else{
            $histogram = Histogram_billing_details::whereNull('pcn')->get();

            $data =Histogram_billing_details::where('pcn','LIKE','%'.$search.'%')
            ->orWhere('pcn','LIKE','%'.$search.'%')
            ->orWhere('billing_name','LIKE','%'.$search.'%')
            ->orWhere('location','LIKE','%'.$search.'%')
            ->orWhere('project_name','LIKE','%'.$search.'%')
            ->orWhere('area','LIKE','%'.$search.'%')
            ->orWhere('city','LIKE','%'.$search.'%')
            ->orWhere('state','LIKE','%'.$search.'%')
            ->get(); 

            return view('histogram/list',compact('data','histogram','search'));
        }
    }

    public function delete_history($id , $histogram_id){
       
       $check = HistogramHistory::where('histogram_id',$histogram_id)->count();

       if($check > 1){
           $data = HistogramHistory::where('id',$id)->first();
           $path = $data->path.'/'.$data->filename ;

            if (File::exists($path)) {
                    
                    unlink($path);
                }

            $delete = HistogramHistory::where('id',$id)->delete();  
            
            if($delete){
                 return redirect()->back()->withMessage('Histogram History Successfully Deleted');
            } 
            else {
                 return redirect()->back()->withMessage('Could not be deleted , Please contact Super Admin.');
            }

       }else{
        return redirect()->back()->withMessage('Can not be deleted .There must be at lease one document for review purpose');
       }

        print_r($check); die();

    }
}
