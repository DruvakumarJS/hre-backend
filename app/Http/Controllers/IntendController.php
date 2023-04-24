<?php

namespace App\Http\Controllers;

use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Indent_tracker;
use App\Models\GRN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportIndents;
use Excel;

class IntendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $indents=Intend::orderBy('id', 'DESC')->paginate(10);
        $activeCount = Intend::where('status','Active')->count();
        $pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
        //print_r($pendingCount);

         return view('indent/list' , compact('indents' , 'activeCount', 'pendingCount' , 'compltedCount'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return view('indent/details',compact('id'));
        $indents= Intend::select('id', 'pcn')->where('indent_no',$id)->first();
        $indent_id = $indents->id ;
        $pcn = $indents->pcn ;

        $indents_list = Indent_list::where('indent_id',$indent_id)->paginate(10);

       // print_r($indents_list);die();
         return view('indent/view_indents',compact('id' , 'indents_list' , 'pcn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $indend_data = Indent_list::where('id' , $id)->first();

       $grn = GRN::where('indent_list_id' , $id)->orderby('id', 'DESC')->get();
       $dispatched = $grn->sum('dispatched');
       return view('indent/edit_indent_items',compact('indend_data' , 'id' , 'grn' ,'dispatched'));
    }

    /**
     * Update the specified resource in storage.    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intend $intend)
    {
        //
    }

    public function update_quantity(Request $request)
    {
       print_r($request->Input());die();

        $Insert = Indent_tracker::create([
            'indent_list_id' => $request->id,
            'indent_no' => $request->indent_no,
            'pcn' => $request->pcn,
            'quantity' => $request->quantity,
        ]);

        if($Insert){

            $indent_list = Indent_list::where('id',$request->id)->first();
            
            $pending = intval($indent_list->pending)-intval($request->quantity);
            $received = intval($indent_list->recieved)+intval($request->quantity);

            $update_indent_list = Indent_list::where('id',$request->id)->update([
                'pending' => $pending,
                'recieved' => $received ]);


            if($update_indent_list){

            $indent_data = Intend::where('indent_no',$request->indent_no)->first();

            $pending = intval($indent_data->pending)-intval($request->quantity);
            $received = intval($indent_data->recieved)+intval($request->quantity);

            $update_indent = Intend::where('indent_no',$request->indent_no)->update([
                'pending' => $pending,
                'recieved' => $received ]);

            if($update_indent){
                 return redirect()->route('edit_intends',$request->id)
                               ->withmessage('Could not update quantity');
            }

               
            }

            
        }
        else {
            return redirect()->route('edit_intends',$request->id)
                            ->withmessage('Could not update quantity');
        }

    }

    public function update_dispatches(Request $request)
    {
         //print_r($request->Input());die();

         if($request->quantity > $request->pending){
            return redirect()->route('edit_intends',$request->id)
                             ->withmessage("Dispatch Quantity should be less than Pending Quantity")
                             ->withInput();
         }
         else{

            if(GRN::exists()){
                $GRN_id = GRN::select('grn')->orderBy('id' ,'DESC')->first();
                $GRN_id = ++$GRN_id->grn;
            }
            else {
                $GRN_id = "GRN001";
            }

            $indent = Intend::select('user_id')->where('indent_no', $request->indent_no)->first();

            $Insert = GRN::create([
                'grn' => $GRN_id ,
                'user_id' => $indent->user_id,
                'indent_list_id' => $request->id,
                'indent_no' => $request->indent_no,
                'pcn' => $request->pcn,
                'dispatched' => $request->quantity,
                'status' => "Awaiting for Confirmation"
            ]);


            return redirect()->route('edit_intends',$request->id)
                            ->withmessage('GRN created successfully');
           
         }

         


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intend $intend)
    {
        //
    }

    public function export($indent_no){

        $Indent = Intend::where('indent_no',$indent_no)->first();
        $IndentList = Indent_list::with('materials')->where('indent_id',$Indent->id)->get();
      
        return Excel::download(new ExportIndents($indent_no) , 'indents_'.$indent_no.".csv");

    }
}
