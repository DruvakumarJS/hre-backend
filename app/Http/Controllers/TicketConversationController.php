<?php

namespace App\Http\Controllers;

use App\Models\TicketConversation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($request->Input());die();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function show(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketConversation $ticketConversation)
    {
        //
    }
}
