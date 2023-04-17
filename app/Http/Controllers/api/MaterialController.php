<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material ;

class MaterialController extends Controller
{
    function material_data(Request $request){
       // print_r($request->Input());

    	if(isset($request->material_id))
    	{
    	$material_id = $request->material_id ; 

    	$data = Material::where('item_code',$material_id)->first();

    	if(!empty($data)){

    	$information = $data->information ;

    	$material_data = [
    		'material_id' => $data->item_code,
    		'name' =>  $data->name,
    		'brand' =>  $data->brand,
    		'uom' =>  $data->uom,
    		'information' => json_decode($information)

    	];

    		return response()->json([
    		'status'=> 1 ,
    		'data' => array($material_data)]);

    	}
    	else {
    		return response()->json([
    		'status'=> 1 ,
    		'data' => ""]);

    	}
    

    	}

    	else {

    		if(isset($request->material_name) && isset($request->material_brand)){
    		 $material_name = $request->material_name ;
    		 $material_brand = $request->material_brand ;

    		 $data = Material::where('name',$material_name)->where('brand' , $material_brand)->get();

    		 $material_array=array();

             if(sizeof($data)>0){
             	foreach ($data as $key) {
             		$information = $key['information'] ;

		    	$material_data = [
		    		'material_id' => $key['item_code'],
		    		'name' => $key['name'],
		    		'brand' => $key['brand'],
		    		'uom' => $key['uom'],
		    		'information' => json_decode($information)

		    	];

		    	array_push($material_array, $material_data);
             	}

             	return response()->json([
		    		'status'=> 1 ,
		    		'data' => $material_array]);

             
             	

             }
             else {
             	return response()->json([
	    		'status'=> 1 ,
	    		'data' => ""]);
             }


    		}
    		else {
    			$material_name = $request->material_name ;

    			 $data = Material::where('name',$material_name)->get();

    			  $material_array=array();

             if(sizeof($data)>0){
             	foreach ($data as $key) {
             		$information = $key['information'] ;

		    	$material_data = [
		    		'material_id' => $key['item_code'],
		    		'name' => $key['name'],
		    		'brand' => $key['brand'],
		    		'uom' => $key['uom'],
		    		'information' => json_decode($information)

		    	];

		    	array_push($material_array, $material_data);
             	}

             	return response()->json([
		    		'status'=> 1 ,
		    		'data' => $material_array]);

             
             	

             }
             else {
             	return response()->json([
	    		'status'=> 1 ,
	    		'data' => ""]);
             }
    		}


    	}
       } 

        function material_list(Request $request){

            if(isset($request->user_id)){

                $materials = Material::select('name')->groupBy('name')->get();

            return response()->json([
                "status"=> 1 ,
                "message" => "success",
                "data" => $materials]);

            }
            else {
            return response()->json([
                "status"=> 0 ,
                "message" => "Authentication failure",
                "data" => ""]);
            }
            
        }


     
    
}
