<?php

namespace App\Http\Controllers;

use App\Models\Pcn;
use App\Models\Customer;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportPcn;
use Excel;
use Auth ;
class PcnController extends Controller
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
        if(Auth::user()->id == '1'){
           $pcns = Pcn::orderBy('id','DESC')->paginate(20); 
        }
        else {
             $pcns = Pcn::where('status','Active')->orderBy('id','DESC')->paginate(20); 
        }
       
       return view('pcn/list', compact('pcns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //print_r($request->Input()); die();
       
        $pcn = 'PCN_'.$request->pcn;
       if (Pcn::where('pcn',$pcn)->exists()) {

               return redirect()->back()
                        ->withMessage('PCN already exists')
                        ->withInput();
        }

    
        else {

            if($request->start_date == ''){
            $start_date = date('Y-m-d');
        }
        else{
            $start_date = $request->start_date ;
        }

         if($request->actual_start_date == ''){
            $actual_start_date = date('Y-m-d');
        }
        else{
            $actual_start_date = $request->actual_start_date ;
        }

            $targeted_days='';

            if($request->holiday == 'No' || $request->holiday == ''){
                $approved_days = '0';
            }
            else {
                $approved_days = $request->approved_holidays;
            }

            if($request->end_date != ""){
                 $end = strtotime($request->end_date);
                $start = strtotime($request->start_date);
                $days = $end - $start ; 

                $total_days = round($days / (60 * 60 * 24)); 
                $targeted_days = $total_days - $approved_days +1;

            }


            $createPCN = Pcn::create([
                'pcn'=>'PCN_'.$request->pcn ,
                'customer_id' => $request->customer_id ,
                'client_name' => $request->client_name,
                'brand' => $request->brand ,
                'work' => $request->work,
                'location' => $request->loc,
                'area' => $request->building,
                'city' => $request->city,
                'state' => $request->state,
                'gst' => $request->gst ,
                'proposed_start_date' => $start_date,
                'proposed_end_date' => $request->end_date,
                'approve_holidays' => $request->holiday,
                'approved_days' => $approved_days,
                'targeted_days' => $targeted_days,
                'actual_start_date' => $actual_start_date,
                'actual_completed_date' => $request->actual_end_date,
                'hold_days' => $request->hold_days,
                'assigned_to' => $request->user_id,
                'status' => "Active",
                'owner' => $request->user_id,
        ]);

            if($createPCN){
                //return redirect()->route('PCN');
                return redirect()->back()->with('PCN' , 'PCN_'.$request->pcn);
            }
            else{
                 return redirect()->route('create_pcn')->withMessage('Something went wrong')->withInput(); ;
            }



            }

    }


      

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pcn  $pcn
     * @return \Illuminate\Http\Response
     */
    public function show(Pcn $pcn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pcn  $pcn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pcn_data = Pcn::where('pcn', $id)->first();
       
        return view('pcn/edit',compact('pcn_data' , 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcn  $pcn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // print_r($request->Input());die();

        $achieved_days = '';
        $holdDays = '';
        $targeted_days="";



        if($request->actual_end_date != ''){
            $end = strtotime($request->actual_end_date);
            $start = strtotime($request->actual_start_date);
            $days = $end - $start ; 

            $total_days = round($days / (60 * 60 * 24)); 
            $achieved_days = $total_days - $request->hold_days + 1;

            if($request->hold_days == ''){
                $request->hold_days = '0';
            }

        }
         if($request->holiday == 'No' || $request->holiday == ''){
                $approved_days = '0';
            }
            else {
                $approved_days = $request->approved_holidays;
            }


         if($request->end_date != ""){
                $end = strtotime($request->end_date);
                $start = strtotime($request->start_date);
                $days = $end - $start ; 

                $total_days = round($days / (60 * 60 * 24)); 
                $targeted_days = $total_days - intval($approved_days) + 1;

            }

            $updatePCN = Pcn::where('pcn' ,$request->pcn)->update([
                'customer_id' => $request->customer_id ,
                'client_name' => $request->client_name,
                'brand' => $request->brand ,
                'work' => $request->work,
                'location' => $request->loc,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'proposed_start_date' => $request->start_date,
                'proposed_end_date' => $request->end_date,
                'approve_holidays' => $request->holiday,
                'approved_days' => $approved_days,
                'targeted_days' => $targeted_days,
                'actual_start_date' => $request->actual_start_date,
                'actual_completed_date' => $request->actual_end_date,
                'hold_days' => $request->hold_days,
                'days_acheived'=> $achieved_days,
                'status' => $request->status
                
        ]);

            if($updatePCN){
                return redirect()->route('view_pcn');
            }
            else{
                 return redirect()->back()->withMessage('Something went wrong')->withInput(); ;
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pcn  $pcn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pcn $pcn)
    {
        //
    }

    public function create_pcn()
    {
        $managerlist = Employee::where('role','manager')->get();
        return view('pcn/create_pcn',compact('managerlist'));
    }

    public function view_pcn()
    {
        $pcns = Pcn::orderBy('id', 'DESC')->paginate(20);
        return view('pcn/view_pcn' , compact('pcns'));
    }


    function action(Request $request)
    {
    
        $data = Customer::select("name as value", "id" )
                    ->with("address")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocomplete_pcn(Request $request){

        $data = Pcn::select("pcn as value" , 'client_name' , 'brand' , 'location', 'area' , 'city' , 'state')
                    ->where('pcn', 'LIKE', '%'. $request->get('search'). '%')
                    ->where('status' , 'Active')
                    ->get();
    
        return response()->json($data);

    }

    public function export(){

        return Excel::download(new ExportPcn() , "PCNs.csv");

    }

    public function search(Request $request){
      
      $search = $request->search;
           $pcns = Pcn::where('pcn','LIKE', '%'.$request->search.'%')
           ->orWhere('client_name','LIKE', '%'.$request->search.'%')
           ->orWhere('brand','LIKE', '%'.$request->search.'%')
           ->orWhere('location','LIKE', '%'.$request->search.'%')
           ->orWhere('area','LIKE', '%'.$request->search.'%')
           ->orWhere('city','LIKE', '%'.$request->search.'%')
           ->orWhere('state','LIKE', '%'.$request->search.'%')
           ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('email', 'like', '%'.$search.'%');
                           })
           ->orderBy('id','DESC')->paginate(20); 
       
       return view('pcn/list', compact('pcns'));

    }


}
