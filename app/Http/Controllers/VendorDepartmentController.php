<?php

namespace App\Http\Controllers;

use App\Models\VendorDepartment;
use App\Models\VendorStaff;
use App\Models\FootPrint;
use App\Models\VendorHeadings;
use Illuminate\Http\Request;
use DB;
use Auth;

class VendorDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = '';
        $data = VendorDepartment::orderBy('vid','DESC')->paginate(25);
        return view('vendor/list',compact('data','search'));
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
       // print_r($request->Input()); die();

      if(VendorDepartment::where('vid_id',$request->vid)->exists()){
 
           return redirect()->back()->withMessage('Please check the VID .It already exists')->withInput();
        }

        if(VendorDepartment::where('gst',$request->gst)->exists()){
 
           return redirect()->back()->withMessage('Please check the GST number . It already exists')->withInput();
        }
       
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
        
            $footprint = FootPrint::create([
                  'action' => 'New Vendor created - '.'VID_'.$request->vid,
                  'user_id' => Auth::user()->id,
                  'module' => 'Vendor ',
                  'operation' => 'C'
              ]);

        
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
       // print_r(json_encode($request->Input()) );die();

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

        $delete =  VendorStaff::where('vendor_id' , $request->id)->delete();

        if($delete){
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

        $footprint = FootPrint::create([
                  'action' => 'New details modified - '.'VID_'.$request->vid,
                  'user_id' => Auth::user()->id,
                  'module' => 'Vendor ',
                  'operation' => 'U'
              ]);

        return redirect()->route('vendor_master');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorDepartment  $vendorDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // print_r($id) ; die();
       /* $vendor = VendorDepartment::where('id', $id)->first();
        $v_id = $vendor->vid;
        $delete_staff = VendorStaff::where('vendor_id', $id)->delete();

        if($delete_staff){
            $delete_vendor = VendorDepartment::where('id', $id)->delete();

            if($delete_staff){
                $footprint = FootPrint::create([
                  'action' => 'Vendor deleted - '.$v_id,
                  'user_id' => Auth::user()->id,
                  'module' => 'Vendor ',
                  'operation' => 'D'
              ]);
                return redirect()->Back()->withMessage('vendor deleted Successfully');
            }
            else{
                 return redirect()->Back()->withMessage('Error while deleting vendor. ');
            }
        }
        else {
             return redirect()->Back()->withMessage('Error while deleting vendor Staffs');
        }*/

         $vendor = VendorDepartment::where('id', $id)->first();
        $v_id = $vendor->vid;

         $delete_vendor = VendorDepartment::where('id', $id)->delete();

            if($delete_vendor){
                $footprint = FootPrint::create([
                  'action' => 'Vendor deleted - '.$v_id,
                  'user_id' => Auth::user()->id,
                  'module' => 'Vendor ',
                  'operation' => 'D'
              ]);
                return redirect()->Back()->withMessage('vendor deleted Successfully');

            }
            else {
               return redirect()->Back()->withMessage('Error while deleting vendor. ');
            }

    }

    public function search(Request $request){
        $search = $request->search;
        
        if($search == ''){
            return redirect()->route('vendor_master');
        }else{

        $data = VendorDepartment::orderBy('vid','DESC')
        ->where('vid','LIKE','%'.$search.'%')
        ->orWhere('billing_name','LIKE','%'.$search.'%')
        ->orWhere('vendor_type','LIKE','%'.$search.'%')
        ->orWhere('building','LIKE','%'.$search.'%')
        ->orWhere('area','LIKE','%'.$search.'%')
        ->orWhere('city','LIKE','%'.$search.'%')
        ->orWhere('state','LIKE','%'.$search.'%')
        ->orWhere('owner','LIKE','%'.$search.'%')
        ->orWhere('mobile','LIKE','%'.$search.'%')
        ->orWhere('email','LIKE','%'.$search.'%')
        ->paginate(25)
        ->withQueryString();
        return view('vendor/list',compact('data','search'));
        }

    }

    public function autocomplete_vendor(Request $request){
        $search = $request->get('search') ;
       
                    $data = DB::table('vendor_departments')
            ->select(
                    'vendor_departments.vid',
                    'vendor_departments.billing_name',
                    'vendor_departments.owner',
                    'vendor_departments.mobile',
                    'vendor_departments.id',
                    /*'vendor_staff.email',
                    'vendor_staff.mobile',*/
                     DB::raw("CONCAT(vendor_departments.vid,' - ',vendor_departments.billing_name) AS value") 
                    
                )
          // ->select( DB::raw("CONCAT(users.name,' - ',roles.alias) AS value") )
            //->join('vendor_staff', 'vendor_departments.id', '=', 'vendor_staff.vendor_id')
            
            ->where(function($query)use ($search){
                    $query->where('vendor_departments.vid_id','LIKE','%'.$search.'%')
                    ->orWhere('vendor_departments.vid','LIKE','%'.$search.'%')
                    ->orWhere('vendor_departments.billing_name','LIKE','%'.$search.'%');
                 })
            ->whereNull('deleted_at')
        
            ->get();
         
        return response()->json($data);
    }

    public function vendor_headings(){
      $data = VendorHeadings::paginate(50);
      $search = '';
      return view('vendor.departments',compact('data','search'));
    }

    public function save_heading(Request $request){
     // print_r("kk"); die();

      $save = VendorHeadings::create(['headings' => $request->name , 'description' => $request->desc ]) ;

      if($save){
        return redirect()->route('vendor_headings');
      }
    }

    public function update_heading(Request $request){
     // print_r("kk"); die();

      $save = VendorHeadings::where('id', $request->id)->update(['headings' => $request->name , 'description' => $request->desc ]) ;

      if($save){
        return redirect()->route('vendor_headings');
      }
    }

    public function delete_heading($id){
      $dalete = VendorHeadings::where('id', $id)->delete();
      
      if($dalete){
        return redirect()->route('vendor_headings');
      }

    }

    public function search_vendor_headings(Request $request){
      $search=$request->search;
      $data = VendorHeadings::where('headings', 'LIKE','%'.$search.'%')->orWhere('description', 'LIKE','%'.$search.'%')->paginate(50);
      return view('vendor.departments',compact('data' ,'search'));
    }

    
}
