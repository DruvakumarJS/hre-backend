<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MaterialList = Material::paginate(10);
       
       return view('material/list', compact('MaterialList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

       // $searchcategoty = Material::where()
     
      if($data = Material::exists()){

        $Material_id=Material::select('item_code')->orderBy('id', 'DESC')->first();

         $itemcode = ++$Material_id->item_code;

         $MaterialData = Material::create([
            'category_id' => $request->category_id,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'size' =>$request->size,
            'thickness' =>$request->thickness,
            'grade' =>$request->grade,
            'shade_no' =>$request->shade,
            'unit'=> $request->unit,
      ]);

      }
      else{

         $itemcode = $request->category_hint ."00001";

         $MaterialData = Material::create([
            'category_id' => $request->category_id,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'size' =>$request->size,
            'thickness' =>$request->thickness,
            'grade' =>$request->grade,
            'shade_no' =>$request->shade,
            'unit'=> $request->unit,
      ]);

      }
      return redirect()->route('materials');
     

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
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $c_name = Category::select('category' , 'material_category')->where('code',$id)->first();

        $category = $c_name->category ;
        $material_category = $c_name->material_category ;

        //print_r($c_name->name);die();
         return view('material/add_product',compact('id','category','material_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c_name = Category::select('category' , 'material_category')->where('code',$id)->first();

        $category = $c_name->category ;
        $material_category = $c_name->material_category ;

         $MaterialList = Material::where('category_id',$id)->get();
       
       return view('material/edit_products', compact('MaterialList' ,'category','material_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }


}
