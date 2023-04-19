<?php

namespace App\Http\Controllers;

use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Indent_tracker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $indents=Intend::paginate(20);

         return view('indent/list' , compact('indents'));
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

       $indent_tracker = Indent_tracker::where('indent_list_id' , $id)->get();
       return view('indent/edit_indent_items',compact('indend_data' , 'id' , 'indent_tracker'));
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
       // print_r($request->Input());die();

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
}
