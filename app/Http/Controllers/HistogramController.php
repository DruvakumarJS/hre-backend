<?php

namespace App\Http\Controllers;

use App\Models\Histogram;
use App\Models\Histogram_billing_details;
use App\Models\HreDetail;
use App\Models\HistogramClientDetails;
use App\Models\HistogramArchitectDetails;
use App\Models\HistogramLandlordDetails;
use App\Models\VendorDetail;
use App\Models\Pcn;
use Illuminate\Http\Request;
use Auth;

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

        return view('histogram/list',compact('data','histogram'));
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
        //print_r(json_encode($request->Input())); die();

        $billing = new Histogram_billing_details;
        $billing->billing_name=$request->billing_name;
        $billing->gst = $request->gst;
        $billing->project_name = $request->project_name;
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

        $billing->save();

        $billing_id = $billing->id ;

        if($billing_id != 0 || $billing_id != ''){

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

       // print_r($billing_id); die();

        return redirect()->route('histogram');
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
            'brand'=>$pcn_details->brand,
            'gst'=> $pcn_details->gst,
            'location'=>$pcn_details->location,
            'area'=> $pcn_details->area,
            'city' => $pcn_details->city,
            'state'=> $pcn_details->state,
            'pincode'=> $pcn_details->pincode,
            'form_verified_by' => Auth::user()->id,
            'pcn_alloted_by' => Auth::user()->id
        ]) ;
       // 

        return redirect()->route('histogram');
        
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
}
