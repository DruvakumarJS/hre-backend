<?php

namespace App\Http\Controllers;

use App\Models\VendorDepartment;
use App\Models\VendorStaff;
use Illuminate\Http\Request;

class VendorDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VendorDepartment::orderBy('vid','DESC')->get();
        return view('vendor/list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('vendor/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  print_r($request->Input()); die();

        $vendor = new VendorDepartment;
        $vendor->vid_id = $request->vid;
        $vendor->vid = 'VID_'.$request->vid;
        $vendor->billing_name = $request->billing_name;
        $vendor->vendor_type = $request->vendor_type;
        $vendor->gst = $request->gst;
        $vendor->pan = $request->pan;
        $vendor->tin = $request->tin;
        $vendor->owner = $request->owner_name;
        $vendor->mobile = $request->owner_mobile;
        $vendor->email = $request->owner_email;
        $vendor->building = $request->building;
        $vendor->area = $request->area;
        $vendor->location = $request->location;
        $vendor->city = $request->city;
        $vendor->state = $request->state;
        $vendor->pincode = $request->pincode;

        $vendor->save();

        $vendor_id = $vendor->id;

        if($vendor_id != 0 || $vendor_id != ''){
            
            foreach($request->client as $key=>$value){
              VendorStaff::create([
                'vendor_id' => $vendor_id ,
                'name' => $value['name'],
                'designation' => $value['designation'] ,
                'mobile' => $value['contact'] ,
                'email' => $value['email'] 
            ]);
            }
        }
        
       return redirect()->route('vendor_master');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorDepartment  $vendorDepartment
     * @return \Illuminate\Http\Response
     */
    public function show(VendorDepartment $vendorDepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorDepartment  $vendorDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = VendorDepartment::with('vendor_staffs')->where('id',$id)->first();
        //print_r(json_encode($data)); die();
        return view('vendor/edit',compact('data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorDepartment  $vendorDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // print_r($request->Input());die();

        $update = VendorDepartment::where('id',$request->id)->update([
            'vid_id' =>  $request->vid,
            'vid' =>  'VID_'.$request->vid,
            'billing_name' =>  $request->billing_name,
            'vendor_type' =>  $request->vendor_type,
            'gst' =>  $request->gst,
            'pan' =>  $request->pan,
            'tin' =>  $request->tin,
            'pincode' => $request->pincode,
            'owner' =>  $request->owner_name,
            'mobile' =>  $request->owner_mobile,
            'email' =>  $request->owner_email,
            'building' =>  $request->building,
            'area' =>  $request->area,
            'location' =>  $request->location,
            'city' =>  $request->city,
            'state' =>  $request->state
        ]);

        if($update){
            foreach($request->client as $key=>$value){
              VendorStaff::create([
                'vendor_id' => $request->id ,
                'name' => $value['name'],
                'designation' => $value['designation'] ,
                'mobile' => $value['contact'] ,
                'email' => $value['email'] 
            ]);
            }
        }

        return redirect()->route('vendor_master');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorDepartment  $vendorDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorDepartment $vendorDepartment)
    {
        //
    }
}
