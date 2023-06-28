<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth ;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Notification::where('user_id',$id)->orderBy('id', 'DESC')->get();

        return view('notification', compact('data'));

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
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       $id  = $request->id ;
       $module = $request->module;

       $update =  Notification::where('id', $id)->update(['status' => '1']);

       if($module == 'Tickets'){
        return redirect()->route('tickets');
       }
       else if($module == 'Pettycash'){
        return redirect()->route('pettycash');
       }
       else if($module == 'GRN'){
        return redirect()->route('grn');
       }
        else if($module == 'Indents'){
        return redirect()->route('intends');
       }
       else if($module == 'Attendance'){
        return redirect()->route('employee-history',Auth::user()->id);
       }
       else {
        return redirect()->back();
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
