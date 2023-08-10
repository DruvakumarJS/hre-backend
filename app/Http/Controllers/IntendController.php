<?php

namespace App\Http\Controllers;

use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Indent_tracker;
use App\Models\GRN;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Employee;
use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportIndents;
use App\Mail\IndentsMail;
use App\Mail\GRNMail;
use Excel;
use Auth ;
use DB;
use PDF;
use Mail;

class IntendController extends Controller
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

       if(Auth::user()->role_id != 4 ) {
        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->orderBy('created_at', 'ASC')->paginate(50);

        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
       }
       else {
        $indents=Intend::where('user_id' ,Auth::user()->id)->paginate(50);
        $all = Intend::where('user_id' ,Auth::user()->id)->count();
        $activeCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Active')->count();
      // $pendingCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Completed')->count();
       }
        
        //print_r($pendingCount);

         return view('indent/list' , compact('indents' , 'all' , 'activeCount' , 'compltedCount'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('indent/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // print_r(json_encode($request->Input()));die();

        if(empty($request->pcn)){
             return redirect()->back()->withMessage('PCN does not exist ')->withInput();
        }
        else if (!empty($request->pcn)){
            if(Pcn::where('pcn',$request->pcn)->exists()){


        if(!empty($request->indent)){
         
        if(Intend::exists()){
            $Indent = Intend::select('indent_no')->orderBy('id', 'DESC')->first();

             $arr = explode("MI00", $Indent->indent_no);
           
            $ind_no = "MI00".++$arr[1];

           //  print_r($indent_no);die();
          }
          else {
            $ind_no = "MI001" ;
          }

          $indent_array = $request->indent ; 


          $create_indent = Intend::create([
                                  'indent_no' => $ind_no,
                                  'pcn' => $request->pcn ,
                                  'user_id' => Auth::user()->id,
                                  'quantity' => "0",
                                  'recieved'=> "0",
                                  'pending'=>"0",
                                  'status'=>'Active'
          ]);

          if($create_indent){
            $indent_id = Intend::select('id')->where('indent_no', $ind_no)->first();

            $totalQualntity = 0;

            //  print_r($indent_array); die();

             foreach ($indent_array as $key => $value) {

                if(!isset($value['desc'])) {
                    $desc = 'nil';
                } 
                else{
                    $desc = $value['desc'] ;
                }
          
             $indents = Indent_list::create([
                                  'indent_id' => $indent_id->id,
                                  'material_id' => $value['item_code'],
                                  'decription' => $desc,
                                  'quantity' => $value['quantity'],
                                  'recieved'=> "0",
                                  'pending'=>$value['quantity'],
                                  'status'=>'Active']);

             if($indents){
                    if($totalQualntity=="0"){
                      $totalQualntity = $value['quantity'] ;

                    }
                    else {
                      $totalQualntity = intval($totalQualntity) + intval($value['quantity']);

                    }
             }

             }

              $update_indents = Intend::where('indent_no', $ind_no)->update([
                                          'quantity' => $totalQualntity,
                                          'recieved'=> "0",
                                          'pending'=>$totalQualntity,
                                  ]);

          }

         // return redirect()->route('intends');

           $idtend= Intend::where('indent_no',$ind_no)->first();
           $pdf_array = Indent_list::where('indent_id' , $idtend->id)->with('materials')->get();

           foreach ($pdf_array as $key => $value) {
             $data[] = [
              'material_id' => $value->material_id ,
              'name' => $value->materials->name ,
              'brand' => $value->materials->brand ,
              'quantity' => $value->quantity,
              'comments' => $value->decription,
              'uom'=> $value->materials->uom,

             ];
           }
          
          $pcn_data=Pcn::where('pcn',$idtend->pcn)->first();

         $pcn_detail = $pcn_data->client_name . " , ".$pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

          
           $indent_details = [
                 'indent_no' => $idtend->indent_no,
                 'pcn' => $idtend->pcn ,
                 'pcn_details'=> $pcn_detail ,
                 'creator' =>Auth::user()->name,
                 'details'=> $data     
          ];
          
        $filename = 'indent.pdf';
        $pdf = PDF::loadView('pdf/indentsPDF', compact('indent_details'));
    
        $savepdf = $pdf->save(public_path($filename));

       // $filename = public_path($filename);
        $attachment = public_path($filename) ;
       /* if($savepdf){
           
          $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first(); 

          $subject = "New Indent : " .$empl->employee_id." - ".$ind_no ." - ".$request->pcn;

          $emailarray = User::select('email')->where('role_id','3')->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

        //  Mail::to($emailid)->send(new IndentsMail($indent_details,$subject,$attachment));
          // Mail::to('druva@netiapps.com')->send(new IndentsMail($indent_details,$subject,$attachment));

    

           $data= ['indent_no' =>$ind_no , 'pcn'=>$idtend->pcn , 'detail'=>$pcn_detail ];
           
           return redirect()->back()->with('Indent',$data);
        }*/

         $data= ['indent_no' =>$ind_no , 'pcn'=>$idtend->pcn , 'detail'=>$pcn_detail ];
           
           return redirect()->back()->with('Indent',$data);

     }
     else {
        return redirect()->back()->withMessage('Please Choose Materials ');
     }

     }
            else {
                 return redirect()->back()->withMessage('PCN does not exist');
            }
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return view('indent/details',compact('id'));
        $indents= Intend::select('id', 'pcn')->where('indent_no',$id)->first();
        $indent_id = $indents->id ;
        $pcn = $indents->pcn ;

        $indents_list = Indent_list::where('indent_id',$indent_id)->paginate(10);

       // print_r($indents_list);die();
         return view('indent/view_indents',compact('id' , 'indents_list' , 'pcn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $indend_data = Indent_list::where('id' , $id)->first();

       $grn = GRN::where('indent_list_id' , $id)->orderby('id', 'DESC')->get();
       $activegrn = GRN::where('indent_list_id' , $id)->where('status', '!=' ,'Received')->orderby('id', 'DESC')->get();
       $dispatched = $activegrn->sum('dispatched');

      // print_r($dispatched);die();
       return view('indent/edit_indent_items',compact('indend_data' , 'id' , 'grn' ,'dispatched'));
    }

    /**
     * Update the specified resource in storage.    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function edit_grn(Request $request)
    { 
     // print_r($request->Input());die();

       $Update = GRN::where('grn',$request->grn)->update([
               
                'dispatched' => $request->quantity,
                'dispatch_comment' => $request->dispatch_comment,
               
            ]);

       if($Update){
         return redirect()->route('edit_intends',$request->id)
                            ->withmessage('GRN Updated successfully');

       }
       else{
         return redirect()->route('edit_intends',$request->id)
                            ->withmessage('Failed to Update GRN');


       }

           

       
    }

    public function update_quantity(Request $request)
    {
      // print_r($request->Input());die();

        $Insert = Indent_tracker::create([
            'indent_list_id' => $request->id,
            'indent_no' => $request->indent_no,
            'pcn' => $request->pcn,
            'quantity' => $request->quantity,
        ]);

        if($Insert){

            $indent_list = Indent_list::where('id',$request->id)->first();
            
            $pending = intval($indent_list->pending)-intval($request->quantity);
            $received = intval($indent_list->recieved)+intval($request->quantity);

            $update_indent_list = Indent_list::where('id',$request->id)->update([
                'pending' => $pending,
                'recieved' => $received ]);


            if($update_indent_list){

            $indent_data = Intend::where('indent_no',$request->indent_no)->first();

            $pending = intval($indent_data->pending)-intval($request->quantity);
            $received = intval($indent_data->recieved)+intval($request->quantity);

            $update_indent = Intend::where('indent_no',$request->indent_no)->update([
                'pending' => $pending,
                'recieved' => $received ]);

            if($update_indent){
                 return redirect()->route('edit_intends',$request->id)
                               ->withmessage('Could not update quantity');
            }

               
            }

            
        }
        else {
            return redirect()->route('edit_intends',$request->id)
                            ->withmessage('Could not update quantity');
        }

    }

    public function update_dispatches(Request $request)
    {
        // print_r($request->Input());die();

         if($request->quantity > $request->pending){
            return redirect()->route('edit_intends',$request->id)
                             ->withmessage("Dispatch Quantity should be less than Pending Quantity")
                             ->withInput();
         }
         else{

            if(GRN::exists()){
                $GRN_id = GRN::select('grn')->orderBy('id' ,'DESC')->first();

                $arr = explode("GRN00", $GRN_id->grn);

                $GRN_id = 'GRN00'.++$arr[1];

            }
            else {
                $GRN_id = "GRN001";
            }

            $indent = Intend::select('user_id')->where('indent_no', $request->indent_no)->first();

            $Insert = GRN::create([
                'grn' => $GRN_id ,
                'user_id' => $indent->user_id,
                'indent_list_id' => $request->id,
                'indent_no' => $request->indent_no,
                'pcn' => $request->pcn,
                'dispatched' => $request->quantity,
                'dispatch_comment' => $request->dispatch_comment,
                'status' => "Awaiting for Confirmation"
            ]);


            $userdetail = Employee::where('user_id',$indent->user_id)->first();
            $subject = "Materials Dispatched : ".$GRN_id." - ".$request->indent_no." - ".$request->pcn." - ".$request->category;

             $grndata=[
              'grn' => $GRN_id,
              'owner' => $userdetail->name,
              'indent_no' => $request->indent_no,
              'dispatched' => $request->quantity,
             ];
            
             // Mail::to($userdetail->email)->send(new GRNMail($grndata));
              //Mail::to('druva@netiapps.com')->send(new GRNMail($grndata , $subject));


            return redirect()->route('edit_intends',$request->id)
                            ->withmessage('GRN created successfully');
           
         }

         


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intend  $intend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = GRN::where('id', $id)->delete();

        if($delete){
          return redirect()->back();
        }
    }

    public function export($indent_no){

        $Indent = Intend::where('indent_no',$indent_no)->first();
        $IndentList = Indent_list::with('materials')->where('indent_id',$Indent->id)->get();
      
        return Excel::download(new ExportIndents($indent_no) , 'indents_'.$indent_no.".csv");

    }

    public function filter_indents($filter){
        if($filter=='all'){
             $indents=Intend::orderBy('id', 'DESC')->paginate(10);
        }
        else {
             $indents=Intend::where('status',$filter)->orderBy('id', 'DESC')->paginate(10);
        }
       // $indents=Intend::where('status',$filter)->orderBy('id', 'DESC')->paginate(10);
        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        $pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
        //print_r($pendingCount);

         return view('indent/list' , compact('indents' , 'all' , 'activeCount', 'pendingCount' , 'compltedCount'));
    }

    public function action(Request $request){

        // $product = DB::table('materials')
        // ->select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"))
        // ->where('item_code' , 'LIKE', '%'.$request->search.'%')
        // ->orWhere('name' , 'LIKE', '%'.$request->search.'%')
        // ->orWhere('brand' , 'LIKE', '%'.$request->search.'%')
        // ->where('deleted_at','=',null)
        // ->get();

        $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"))
          ->where('item_code' , 'LIKE', '%'.$request->search.'%')
          ->orWhere('name' , 'LIKE', '%'.$request->search.'%')
          ->orWhere('brand' , 'LIKE', '%'.$request->search.'%')
        ->get();

        
        return response()->json($product);

    }

    public function grn(){

        $grns = GRN::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        $grn_array = array();

        if(sizeof($grns)>0){

          foreach ($grns as $key => $value) {

            $indent_list = Indent_list::where('id',$value->indent_list_id)->orderBy('id', 'DESC')->first();

            $material = Material::where('item_code',$indent_list->material_id)->withTrashed()->first();
            
            $material_detail = [
              'material_name' => $material->name,
              'brand' => $material->brand,
              'information' => json_decode($material->information, true, JSON_UNESCAPED_SLASHES),
              'quantity_raised' => $indent_list->quantity,
              'quantity_received' => $indent_list->recieved,
              'quantity_pending' => $indent_list->pending,

            ];

             $grs_data = [
              'date' => $value->created_at,
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'status'=> $value->status,
              'indent_details' => array($material_detail)
            ];

            array_push($grn_array, $grs_data);
          }

         
          }
           return view('indent/grn',compact('grn_array'));
    }

    public function update_grn(Request $request){

      //  print_r($request->Input());die();

        $update_grn_data = GRN::where('grn',$request->grn)->update([
                                       'approved'=> $request->approved,
                                       'damaged' => intval($request->dispatched)-intval($request->approved),
                                       'comment' => $request->comment,
                                       'status' => 'Received'
                                      ]);
        if($update_grn_data){
         
           $GRNdata = GRN::select('indent_list_id', 'indent_no')->where('grn',$request->grn)->first();

           $indent_list = Indent_list::where('id',$GRNdata->indent_list_id)->first();
            
            $pending = intval($indent_list->pending)-intval($request->approved);
            $received = intval($indent_list->recieved)+intval($request->approved);

            if($pending == '0'){
              $status = 'Completed';
            }
            else {
              $status = 'Active';
            }

            $update_indent_list = Indent_list::where('id',$GRNdata->indent_list_id)->update([
                'pending' => $pending,
                'recieved' => $received,
                'status'=> $status]);

            if($update_indent_list){

            $indent_data = Intend::where('indent_no',$GRNdata->indent_no)->first();

            $pending = intval($indent_data->pending)-intval($request->approved);
            $received = intval($indent_data->recieved)+intval($request->approved);

            if($pending == '0'){
              $status = 'Completed';
            }
            else {
              $status = 'Active';
            }

            $update_indent = Intend::where('indent_no',$GRNdata->indent_no)->update([
                'pending' => $pending,
                'recieved' => $received,
                'status'=> $status ]);


            return redirect()->route('grn');

            
               
            }

             

        }
        else {
          return redirect()->back()->withMessage('Could not update GRN');

        }

    }

    public function search(Request $request){
     // print_r($request->search);die();
      $search = $request->search;
      
      if(Auth::user()->role_id != 4 ) {

       $indents = Intend::where('indent_no','LIKE','%'.$search.'%')
                        ->orWhere('pcn','LIKE','%'.$search.'%')
                        ->orWhereHas('pcns', function ($query) use ($search) {
                        $query->where('client_name', 'like', '%'.$search.'%');
                           })
                        ->paginate(50);

                        
        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
       }

       else 
       {
        $indents = Intend::where('indent_no','LIKE','%'.$search.'%')
                        ->orWhere('pcn','LIKE','%'.$search.'%')->where('user_id' ,Auth::user()->id)->paginate(50);
        
        $all = Intend::where('user_id' ,Auth::user()->id)->count();
        $activeCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Active')->count();
      //  $pendingCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Completed')->count();
       }
        
        //print_r($pendingCount);

         return view('indent/list' , compact('indents' , 'all' , 'activeCount' , 'compltedCount'));              

    }

    public function search_grn(Request $request){

      $grns = GRN::where('grn', 'LIKE','%'.$request->search.'%')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        $grn_array = array();

        if(sizeof($grns)>0){

          foreach ($grns as $key => $value) {

            $indent_list = Indent_list::where('id',$value->indent_list_id)->orderBy('id', 'DESC')->first();

            $material = Material::where('item_code',$indent_list->material_id)->withTrashed()->first();
            
            $material_detail = [
              'material_name' => $material->name,
              'brand' => $material->brand,
              'information' => json_decode($material->information, true, JSON_UNESCAPED_SLASHES),
              'quantity_raised' => $indent_list->quantity,
              'quantity_received' => $indent_list->recieved,
              'quantity_pending' => $indent_list->pending,

            ];

             $grs_data = [
              'date' => $value->created_at,
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'status'=> $value->status,
              'indent_details' => array($material_detail)
            ];

            array_push($grn_array, $grs_data);
          }

         
          }
           return view('indent/grn',compact('grn_array'));
    }
}
