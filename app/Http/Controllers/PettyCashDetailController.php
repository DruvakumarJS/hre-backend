<?php

namespace App\Http\Controllers;

use App\Models\PettyCashDetail;
use App\Models\Pettycash;
use Illuminate\Http\Request;

class PettyCashDetailController extends Controller
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

    public function index($id)
    {
         $data = PettyCashDetail::where('pettycash_id' , $id)->orderBy('id', 'DESC')->get();
         $myspent = PettyCashDetail::where('pettycash_id' , $id)->where('isapproved','!=' , '2')->sum('spent_amount');
         $pettycash = Pettycash::where('id', $id)->first();

        return view('pettycash/details',compact('data' , 'pettycash' , 'myspent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Pettycash::where('id' , $id)->first();

        return view('pettycash/add_expenses', compact('data'));
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

        $fileName='';
        $bill_no = 'PC00';

        if(PettyCashDetail::exists()){
                 $conversation_id = PettyCashDetail::select('id')->orderBy('id', 'DESC')->first();                 
                 $bill_no= "PC00".++$conversation_id->id;
            }
            else{                 
                 $bill_no= 'PC001';                
            }

        if($file = $request->hasFile('bill')) {
           
            $file = $request->file('bill') ;
            //$fileName = $file->getClientOriginalName() ;
             $temp = explode(".", $file->getClientOriginalName());
             $fileName=$bill_no . '.' . end($temp);
        
            $destinationPath = public_path().'/pettycashfiles' ;
            $file->move($destinationPath,$fileName);
  
          }

          $createData = PettyCashDetail::create([
                'pettycash_id' => $request->id,
                'billing_no' => $bill_no ,
                'bill_date' => $request->bill_date ,
                'spent_amount' => $request->amount ,
                'purpose' => $request->purpose ,
                'pcn' => $request->pcn,
                'comments' => $request->comment,
                'filename' => $fileName,
                'isapproved' => '0'
            ]);

          $finance = pettycash::select('finance_id')->where('id', $request->id)->first();

          return redirect()->route('pettycash');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCashDetail $pettyCashDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCashDetail $pettyCashDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //print_r($request->Input());die();

        if($request->status == '1'){
            $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();

                $PettyCash = Pettycash::where('id',$Data->pettycash_id)->first();
                 $total_amount = $PettyCash->total;
                 $spend = $PettyCash->spend;
                 $remaining = $PettyCash->remaining;

                 $total_spend = intval($spend)+intval($Data->spent_amount);
                 $outstanding = intval($total_amount)-intval($total_spend);

                 $updatetable = pettycash::where('id',$Data->pettycash_id)->update(['spend'=>$total_spend , 'remaining' => $outstanding]);

                 if($updatetable){

                     return redirect()->back()->withMesage('Updated');
                 }

            }

        }
        else if($request->status == '2'){
             $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();
                $PettyCash = Pettycash::where('id',$Data->pettycash_id)->first();

                 $notify = Notification::create([
                        'module' => 'Pettycash',
                        'message' => 'Hi..A bill of Rs '.$Data->spent_amount.' is Rejected',
                        'user_id' => $PettyCash->user_id,
                        'status'=> '0'
                       ]);

                 return redirect()->back()->withMesage('Updated');
            }
       

        }
        else{
            return redirect()->back()->withMesage('Something went wrong...');
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PettyCashDetail $pettyCashDetail)
    {
        //
    }
}
