<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Models\SizeMaster;
use App\Models\UnitMaster;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportMaterial;
use Excel;
use App\Mail\MaterialMail;
use Mail;


class MaterialController extends Controller
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
        $MaterialList = Material::paginate(10);
         $search = '' ;
       
       return view('material/list', compact('MaterialList','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

       // print_r($request->Input());die();
       
        $data = $request->specifications ;
        $result = array();

        foreach ($data as $key => $value) {

           if(!empty($value['value'])){
            $result[$value['spec']]=$value['value'];
           }
            
        }
         if(sizeof($result)>0){
             $features = json_encode($result);
         }
         else{
             $features = "{}";
         }

      
       // print_r($features);die();
       
      $categoryData = Category::where('code',$request->code)->first(); 
      
      $code = $categoryData->material_category ; 
     
      if($data = Material::exists()){
        
        //$Material_id=Material::select('item_code')->orderBy('id', 'DESC')->first();

        $validate=Material::select('item_code')->where('item_code','LIKE','%'.$code.'%')->orderBy('id', 'DESC')->first();

        if(!empty($validate)){
             $arr = explode($code, $validate->item_code);

        $itemcode = $code.'00'.++$arr[1];
        $t = $request->thickness;
        $thickness = $t . " "."mm";

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'uom' =>$request->uom,
            'information'=> $features,
      ]);   
        }
        else {
        $itemcode = $categoryData->material_category ."001";

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'uom' =>$request->uom,
            'information'=> $features,
      ]);

        }

    
      }
      else{

         $itemcode = $categoryData->material_category ."001";
        

         $MaterialData = Material::create([
            'category_id' => $categoryData->code,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'uom' =>$request->uom,
            'information'=> $features,
      ]);

      }
    //  return redirect()->route('materials');

      if(UnitMaster::where('unit',$request->uom)->exists())
      {
        
      }
      else
      {
        $Units = UnitMaster::create([
        'category_id' => $request->category_id,
        'unit' => $request->uom
        ]);
      }

       $subject = "New material added : ".$itemcode ;
       $material = [
            'category_id' => $categoryData->code,
            'item_code' => $itemcode,
            'name' => $request->name,
            'brand' =>$request->brand,
            'uom' =>$request->uom,
            'information'=> $features
       ];

      $emailarray = User::select('email')->where('role_id','3')->orWhere('role_id', '1')->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }
      Mail::to($emailid)->send(new MaterialMail($subject , $material));

      
       return redirect()->route('add_product',$request->code);
     

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
        $sizemaster = SizeMaster::where('category_id',$categoryData->material_category)->get();
        $unitmaster = UnitMaster::where('category_id',$categoryData->material_category)->get();


       /* $category = $c_name->category ;
        $material_category = $c_name->material_category ;
*/
        //print_r($c_name->name);die();
         return view('material/add_product',compact('categoryData' , 'sizemaster' , 'unitmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $c_name = Category::select('category' , 'material_category')->where('code',$id)->first();

        $category = $c_name->category ;
        $material_category = $c_name->material_category ;

         $MaterialList = Material::where('category_id',$id)->paginate(10);
       
       return view('material/view_products', compact('MaterialList' ,'category','material_category' ,'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id){
         $material_data = Material::where('item_code' , $id)->first();

        // print_r(json_decode($material_data->information));die();

         return view('material/edit_product',compact('material_data'));
    }


    public function update(Request $request)
    {
       // echo "<pre>";
       // print_r($request->Input());die();

        $data = $request->specifications ;
        $result = array();

        foreach ($data as $key => $value) {

           if(!empty($value['value'])){
            $result[$value['spec']]=$value['value'];
           }
            
        }
         if(sizeof($result)>0){
             $features = json_encode($result);
         }
         else{
             $features = "{}";
         }    
        
    
      $update_material = Material::where('item_code' , $request->id)->update([
                                        'name' => $request->name,
                                        'brand' =>$request->brand,
                                        'uom' =>$request->uom,
                                        'information'=> $features]);
      if($update_material){
        
        return redirect()->route('materials');
      }


       
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


    function action(Request $request)
    {

        $data = UnitMaster::select("unit as value")
                    ->where('category_id',$request->search)
                    ->get();
    
        return response()->json($data);
    }

    public function search(Request $request){

        $MaterialList = Material::where('item_code', 'LIKE','%'.$request->search.'%')
        ->orWhere('name', 'LIKE','%'.$request->search.'%')
        ->orWhere('brand', 'LIKE','%'.$request->search.'%')
        ->orWhere('uom', 'LIKE','%'.$request->search.'%')
        ->orWhere('information', 'LIKE','%'.$request->search.'%')
        ->paginate(10);

        $search = $request->search ;
       
      return view('material/list', compact('MaterialList' , 'search'));

    }

    public function search_product(Request $request){

        $c_name = Category::select('category' , 'material_category')->where('code',$request->id)->first();
        $id = $request->id ;
        $search = $request->search ;
        $category = $c_name->category ;
        $material_category = $c_name->material_category ;

        $MaterialList = Material::where('category_id',$request->id)
             ->where(function($query) use ($search){
            $query->where('item_code', 'LIKE','%'.$search.'%')
            ->orWhere('name', 'LIKE','%'.$search.'%')
            ->orWhere('brand', 'LIKE','%'.$search.'%')
            ->orWhere('uom', 'LIKE','%'.$search.'%')
            ->orWhere('information', 'LIKE','%'.$search.'%');
         })
            ->paginate(10);
       
       return view('material/view_products', compact('MaterialList' ,'category','material_category' ,'id'));


    }


}
