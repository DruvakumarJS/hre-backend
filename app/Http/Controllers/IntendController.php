<?php

namespace App\Http\Controllers;

use App\Models\Intend;
use App\Models\Indent_list;
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
        $indents= Intend::select('id')->where('indent_no',$id)->first();
        $indent_id = $indents->id ;

        $indents_list = Indent_list::where('indent_id',$indent_id)->paginate(10);

       // print_r($indents_list);die();
         return view('indent/view_indents',compact('id' , 'indents_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('intend/update',compact('id'));
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
