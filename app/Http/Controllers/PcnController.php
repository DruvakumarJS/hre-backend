<?php

namespace App\Http\Controllers;

use App\Models\Pcn;
use App\Models\Customer;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PcnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pcns = Pcn::where('status','Active')->orderBy('id','DESC')->paginate(20); 
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
      // print_r($request->Input());die();

       $validator = Validator::make($request->all(), [
             'pcn' => 'required|unique:pcns',
           
        ]);

       if ($validator->fails()) {

              return redirect()->route('create_pcn')
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else {


            $createPCN = Pcn::create([
                'pcn'=>$request->pcn ,
                'customer_id' => $request->customer_id ,
                'client_name' => $request->client_name,
                'brand' => $request->brand ,
                'work' => $request->work,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'proposed_start_date' => $request->start_date,
                'proposed_end_date' => $request->end_date,
                'approve_holidays' => "",
                'targeted_days' => $request->target_date,
                'actual_start_date' => $request->actual_start_date,
                'actual_completed_date' => $request->actual_end_date,
                'hold_days' => $request->hold_days,
                'days_acheived' => $request->days_achieved,
                'assigned_to' => $request->user_id,
                'status' => "Active"
        ]);

            if($createPCN){
                return redirect()->route('PCN');
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

            $updatePCN = Pcn::where('pcn' ,$request->pcn)->update([
                'customer_id' => $request->customer_id ,
                'client_name' => $request->client_name,
                'brand' => $request->brand ,
                'work' => $request->work,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'proposed_start_date' => $request->start_date,
                'proposed_end_date' => $request->end_date,
                'approve_holidays' => $request->holiday,
                'targeted_days' => $request->target_date,
                'actual_start_date' => $request->actual_start_date,
                'actual_completed_date' => $request->actual_end_date,
                'hold_days' => $request->hold_days,
                'days_acheived'=> $request->days_achieved,
                'status' => $request->status
                
        ]);

            if($updatePCN){
                return redirect()->route('PCN');
            }
            else{
                 return redirect()->route('create_pcn')->withMessage('Something went wrong')->withInput(); ;
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
        $pcns = Pcn::paginate(20);
        return view('pcn/view_pcn' , compact('pcns'));
    }


    function action(Request $request)
    {
    
        $data = Customer::select("name as value", "id" , "brand")
                    ->with("address")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }


}
