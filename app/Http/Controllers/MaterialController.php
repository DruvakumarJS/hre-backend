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
       
      $categoryData = Category::where('code',$request->code)->first(); 
      $code = $categoryData->material_category ; 
     
      if($data = Material::exists()){
        
        //$Material_id=Material::select('item_code')->orderBy('id', 'DESC')->first();

        $validate=Material::select('item_code')->where('item_code','LIKE','%'.$code.'%')->orderBy('id', 'DESC')->first();

        if(!empty($validate)){
        $itemcode = ++$validate->item_code;

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
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
        else {
        $itemcode = $categoryData->material_category ."00001";

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
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

    
      }
      else{

         $itemcode = $categoryData->material_category ."00001";

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
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

        $categoryData = Category::where('code',$id)->first();

       /* $category = $c_name->category ;
        $material_category = $c_name->material_category ;
*/
        //print_r($c_name->name);die();
         return view('material/add_product',compact('categoryData'));
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
    public function update(Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DeleteMaterial = Material::where('id',$id)->delete();
         return redirect()->route('materials');
    }


}
