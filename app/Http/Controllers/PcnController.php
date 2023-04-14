<?php

namespace App\Http\Controllers;

use App\Models\Pcn;
use App\Models\Customer;
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
        $pcns = Pcn::orderBy('id','DESC')->paginate(20); 
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
    public function edit(Pcn $pcn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcn  $pcn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pcn $pcn)
    {
        //
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

        return view('pcn/create_pcn');
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
