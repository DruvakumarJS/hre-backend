<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\GRN;

class HomeController extends Controller
{
    public function mydashboard(Request $request){
    	$data=array();
    	if(isset($request->user_id)){
    		if(Attendance::where('user_id' , $request->user_id)->where('date',date('Y-m-d'))->exists()){
    			$attendance = 'P';
    		}
    		else {
    			$attendance = 'A';
    		}

    		if(Intend::where('user_id' , $request->user_id)->exists()){
    			$indents = Intend::where('user_id' , $request->user_id)->count();

    		}
    		else {
    			$indents = "0";
    		}

    		if(Ticket::where('creator' , $request->user_id)->exists()){
    			$tickets = Ticket::where('creator' , $request->user_id)->count();

    		}
    		else {
    			$tickets = "0";
    		}


    		if(GRN::where('user_id' , $request->user_id)->where('status', '!=','Received')->exists()){
    			$GRN = GRN::where('user_id' , $request->user_id)->where('status', '!=','Received')->count();

    		}
    		else {
    			$GRN = "0";
    		}

    		$data = ['attendance' => $attendance , 'indents_count' => $indents , 'tickets_count' => $tickets ,'grn_count' => $GRN ];

    		return response()->json([
    			'status' => 0,
    			'message' => 'UnAuthorised',
    			'data'=> $data]);


    	}
    	else{
    		return response()->json([
    			'status' => 0,
    			'message' => 'UnAuthorised',
    			'data'=> $data]);
    	}
    }
}
