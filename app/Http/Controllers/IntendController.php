<?php

namespace App\Http\Controllers;

use App\Models\Intend;
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
         return view('intend/list');
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
        return view('intend/details',compact('id'));
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
