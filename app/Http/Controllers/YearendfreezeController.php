<?php

namespace App\Http\Controllers;

use App\Models\Yearendfreeze;
use Illuminate\Http\Request;
use Auth;

class YearendfreezeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Yearendfreeze::paginate(25);

        return view('year_end_closure', compact('data'));
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
       // print_r($request->Input()); die();

        $save = Yearendfreeze::create([
            'financial_year' => $request->financial_year ,
            'yearend_date' => date('Y-m-d',strtotime($request->date)) ,
            'user_id' => Auth::user()->id,
            'comments' => $request->desc]);

        if($save){
            return redirect()->route('year_end_closure');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Yearendfreeze  $yearendfreeze
     * @return \Illuminate\Http\Response
     */
    public function show(Yearendfreeze $yearendfreeze)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Yearendfreeze  $yearendfreeze
     * @return \Illuminate\Http\Response
     */
    public function edit(Yearendfreeze $yearendfreeze)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Yearendfreeze  $yearendfreeze
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
       //print_r($request->Input() ); die();
        $save = Yearendfreeze::where('id', $id)->update([
            'financial_year' => $request->financial_year ,
            'yearend_date' => date('Y-m-d',strtotime($request->date)),
            'user_id' => Auth::user()->id,
            'comments' => $request->desc]);

        if($save){
            return redirect()->route('year_end_closure');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Yearendfreeze  $yearendfreeze
     * @return \Illuminate\Http\Response
     */
    public function destroy(Yearendfreeze $yearendfreeze)
    {
        //
    }
}
