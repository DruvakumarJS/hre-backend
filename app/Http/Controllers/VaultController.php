<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vault = Vault::all();
        return view('vault/create',compact('vault'));
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
       

        if($file = $request->hasFile('file')) {

             
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
          
            if(Vault::exists()){
                 $id = Vault::select('id')->orderBy('id', 'DESC')->first();
                 
                 $file_name = "DOC_".++$id->id;
                 
            }
            else {
                $file_name = "DOC_01";
            }

            $temp = explode(".", $file->getClientOriginalName());
            $fileName=$file_name . '.' . end($temp);
           
            $destinationPath = public_path().'/vault' ;
            $file->move($destinationPath,$fileName);

          //  print_r($fileName);die();
            $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'filename'=> $fileName ,
            ]);

           
            
          }

          return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function show(Vault $vault)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function edit(Vault $vault)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       //print_r($request->Input());die();

       $vault = Vault::where('id', $request->id)->update(['name' => $request->name]);
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vault = Vault::where('id', $id)->delete();
       return redirect()->back();
    }
}
