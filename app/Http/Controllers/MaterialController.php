<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Models\SizeMaster;
use App\Models\UnitMaster;
use App\Models\User;
use App\Models\Employee;
use App\Jobs\SendMaterialsEmail;
use App\Models\FootPrint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportMaterial;
use Excel;
use App\Mail\MaterialMail;
use Mail;
use DB;
use Auth;

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
        $MaterialList = Material::paginate(25);
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
             $features = json_encode($result,JSON_UNESCAPED_UNICODE);
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

          $empl = Employee::where('user_id', Auth::user()->id)->first();
          
          $emailarray = User::select('email')
                      ->whereIn('role_id',['1','2','6','7','10','11'])
                      ->where('status','Active')
                      ->get();

          $new_material_data = Material::where('item_code', $itemcode)->first();
          $subject = "New Material Created : Material Name - ".$request->name." , Material Code - ".$itemcode ;
          
          $material_data = ['new_data' => $new_material_data , 'employee' => $empl];
          $action = "Create";


          foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

          SendMaterialsEmail::dispatch($material_data,$subject,$emailid,$action) ; 

          $footprint = FootPrint::create([
                    'action' => 'New product created - '.$itemcode,
                    'user_id' => Auth::user()->id,
                    'module' => 'Products',
                    'operation' => 'C'
                ]);
         
          return redirect()->route('add_product',$request->code)->with('material',$material); 

               
        
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

         $MaterialList = Material::where('category_id',$id)->paginate(25);
       
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
        $olddetails=Material::where('item_code' , $request->id)->first();

        $data = $request->specifications ;
        $result = array();

        foreach ($data as $key => $value) {

           if(!empty($value['value'])){
            $result[$value['spec']]=$value['value'];
           }
            
        }
         if(sizeof($result)>0){
             $features = json_encode($result,JSON_UNESCAPED_UNICODE);
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

          $empl = Employee::where('user_id', Auth::user()->id)->first();

          $emailarray = User::select('email')
                        ->whereIn('role_id',['1','2','6','7','10','11'])
                        ->where('status','Active')
                        ->get();

          $new_material_data = Material::where('item_code', $request->id)->first();
          $subject = "Edited Material : Material Name - ".$request->name." , Material Code - ".$request->id ;
          
          $material_data = ['new_data' => $new_material_data , 'old_data'=> $olddetails ,'employee' => $empl];
          $action = "Update";


          foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

          SendMaterialsEmail::dispatch($material_data,$subject,$emailid,$action) ; 

        $footprint = FootPrint::create([
                    'action' => 'Product details modified - '.$request->id,
                    'user_id' => Auth::user()->id,
                    'module' => 'Products',
                    'operation' => 'U'
                ]);
        
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
        $product = Material::where('id',$id)->first();
        $itemcode = $product->item_code ;
        $DeleteMaterial = Material::where('id',$id)->delete();

          $empl = Employee::where('user_id', Auth::user()->id)->first();

          $emailarray = User::select('email')
                      ->whereIn('role_id',['1','2','6','7','10','11'])
                      ->where('status','Active')
                      ->get();
         
          $subject = "Delete Alert!!! Material : Material Name - ".$product->name." , Material Code - ".$product->item_code ;
          
          $material_data = ['new_data' => $product ,'employee' => $empl];
          $action = "Delete";


          foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

          SendMaterialsEmail::dispatch($material_data,$subject,$emailid,$action) ; 

        $footprint = FootPrint::create([
                    'action' => 'Product deleted - '.$itemcode,
                    'user_id' => Auth::user()->id,
                    'module' => 'Products',
                    'operation' => 'D'
                ]);

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

        /*$MaterialList = Material::where('item_code', 'LIKE','%'.$request->search.'%')
        ->orWhere('name', 'LIKE','%'.$request->search.'%')
        ->orWhere('brand', 'LIKE','%'.$request->search.'%')
        ->orWhere('uom', 'LIKE','%'.$request->search.'%')
        ->orWhere(DB::raw('lower(information)'), 'like', '%' . strtolower($request->search) . '%')
        ->paginate(25);

        $search = $request->search ;*/

        //print_r($request->search); die();

        $search = $request->search;
        $search_array = explode(' ', $search);
        $product = array();
        $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"));
  
        foreach ($search_array as $key => $value) {

          if($key == '0'){
           $search = $value;
            
           $product = $product->where(function($query)use($search){
            $query->orWhere('item_code' , 'LIKE', '%'.$search.'%');
            $query->orWhere('name' , 'LIKE', '%'.$search.'%');
            $query->orWhere('brand' , 'LIKE', '%'.$search.'%');
            $query->orWhere(DB::raw('lower(information)'), 'like', '%' . strtolower($search) . '%');
            //$query->orWhere('information' , 'LIKE', '%'.$search.'%');

        });
        

          }
          else if($key > '0'){
          $search = $value;

           $product = $product->where(function($query)use($search){
            $query->orWhere('item_code' , 'LIKE', '%'.$search.'%');
            $query->orWhere('name' , 'LIKE', '%'.$search.'%');
            $query->orWhere('brand' , 'LIKE', '%'.$search.'%');
             $query->orWhere(DB::raw('lower(information)'), 'like', '%' . strtolower($search) . '%');
           // $query->orWhere('information' , 'LIKE', '%'.$search.'%');

            });
           
          }
         
         
        }

        $search = $request->search;
        $MaterialList=$product->paginate(25)->withQueryString();
       
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
            ->orWhere(DB::raw('lower(information)'), 'like', '%' . strtolower($search) . '%');
         })
            ->paginate(25);
       
       return view('material/view_products', compact('MaterialList' ,'category','material_category' ,'id'));


    }


}
