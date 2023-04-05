<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::paginate(50);
       // print_r($categories);die();
        return view('category/list',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $categoryName = $request->name ;
         $material_category = $request->material_category ;
         $unit = $request->unit ;
         $categoryDesc = $request->desc ;

         if($data = Category::exists()){

        $validate = Category::where('category',$categoryName)->get();


         if(sizeof($validate)>0){
             return redirect()->route('materials_master')->withMessage('Category Already Exists')->withInput();
         }
         else {

            $category_id=Category::select('code')->orderBy('id', 'DESC')->first();
            
            $code = ++$category_id->code;

             $CreateCategory = Category::create(
            [
                'code' => $code,
                'category' => $categoryName,
                'material_category' => $material_category,
                'unit' => $unit,
                'description' => $categoryDesc
            ]) ;

         }
         }
   
         else{

           
             $CreateCategory = Category::create(
            [
                'code' => "C001",
                'category' => $categoryName,
                'material_category' => $material_category,
                'unit' => $unit,
                'description' => $categoryDesc
            ]) ;


         }

          return redirect()->route('materials_master');
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Category::where('id',$id)->delete();
        return redirect()->route('materials_master');
    }
}
