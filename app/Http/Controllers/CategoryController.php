<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\FootPrint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportCategory;
use Excel;
use Auth;

class CategoryController extends Controller
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

        $categories = Category::paginate(25);
        $search='';
       // print_r($categories);die();
        return view('category/list',compact('categories','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       // print_r($request->Input());die();
         $categoryName = strtoupper($request->name); ;
         $material_category = strtoupper($request->material_category) ;
        
         $categoryDesc = $request->desc ;

         if($data = Category::exists()){

        $validate = Category::where('category',$categoryName)->get();


         if(sizeof($validate)>0){
             return redirect()->route('materials_master')->withMessage('Category Already Exists')->withInput();
         }
         else {

            $category_id=Category::select('code')->orderBy('id', 'DESC')->first();

            $arr = explode("C00", $category_id->code);

            $code = 'C00'.++$arr[1];
            
           // $code = ++$category_id->code;

             $CreateCategory = Category::create(
            [
                'code' => $code,
                'category' => $categoryName,
                'material_category' => $material_category,
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
                'description' => $categoryDesc
            ]) ;


         }

                    $footprint = FootPrint::create([
                        'action' => 'New Category created- '.$categoryName,
                        'user_id' => Auth::user()->id,
                        'module' => 'Material Category',
                        'operation' => 'C'
                    ]);

          $message = 'Category Name : '.$categoryName .', Category Code : '.$material_category ;
         // return redirect()->route('materials_master');
          return redirect()->back()->with('success',$message);
         }

    public function search(Request $request){
        $search  = $request->search ;

        if($search == ''){
            return redirect()->route('materials_master');
        }

        $categories =  Category::where('category', 'LIKE','%'.$search.'%')
                                ->orWhere('material_category','LIKE','%'.$search.'%')
                                ->orWhere('description','LIKE','%'.$search.'%')
                                ->paginate(25)
                                ->withQueryString();

        return view('category/list',compact('categories','search'));                        

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
    public function update(Request $request)
    {
       // print_r($request->Input());
        $UpdateCategory = Category::where('id',$request->id)
                          ->update(
                            [
                                'category' => $request->name,
                                'material_category' => $request->material_category,
                                'description' => $request->desc
                            ]);

         $footprint = FootPrint::create([
                        'action' => 'Category details modified - '.$request->name,
                        'user_id' => Auth::user()->id,
                        'module' => 'Material Category',
                        'operation' => 'U'
                    ]);
                                     
        return redirect()->route('materials_master');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        $Materials = Material::where('category_id',$id)->get();

        if(sizeof($Materials)>0)
        {
             return redirect()->route('materials_master')->withMessage('Please delete Materials and then try deleting Category')->withInput();
      
        }
        else{
            $cat = Category::where('code',$id)->first();
            $cat_name = $cat->category;
            $delete = Category::where('code',$id)->delete();

            $footprint = FootPrint::create([
                        'action' => 'Category deleted - '.$cat_name,
                        'user_id' => Auth::user()->id,
                        'module' => 'Material Category',
                        'operation' => 'U'
                    ]);

        return redirect()->route('materials_master');
        }

        
    }

  
}
