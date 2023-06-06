<?php

namespace App\Http\Controllers;

use App\Models\Indent_list;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndentListController extends Controller
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
        //
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
     * @param  \App\Models\Indent_list  $indent_list
     * @return \Illuminate\Http\Response
     */
    public function show(Indent_list $indent_list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indent_list  $indent_list
     * @return \Illuminate\Http\Response
     */
    public function edit(Indent_list $indent_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indent_list  $indent_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indent_list $indent_list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indent_list  $indent_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indent_list $indent_list)
    {
        //
    }
}
