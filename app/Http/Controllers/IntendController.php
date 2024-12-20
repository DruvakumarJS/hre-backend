<?php

namespace App\Http\Controllers;

use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Indent_tracker;
use App\Models\GRN;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Roles;
use App\Models\Employee;
use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportIndents;
use App\Mail\IndentsMail;
use App\Mail\GRNMail;
use App\Models\FootPrint;
use App\Jobs\SendIndentEmail;
use App\Jobs\SendDispatchEmail;
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

       if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11 OR Auth::user()->role_id == 12) {
        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
       }
       elseif(Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5){

        $role = Roles::select('id')->where('team_id','3')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       elseif(Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 8 OR Auth::user()->role_id == 9){

        $role = Roles::select('id')->where('team_id','4')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       else {
        $indents=Intend::where('user_id' ,Auth::user()->id)->paginate(25);
        $all = Intend::where('user_id' ,Auth::user()->id)->count();
        $activeCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Active')->count();
      // $pendingCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Completed')->count();
       }
        
        //print_r($pendingCount);
       $search = '';
       $filtr = 'all';

         return view('indent/list' , compact('indents' , 'all' , 'activeCount' , 'compltedCount','search','filtr'));
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

             $arr = explode("MI_00", $Indent->indent_no);
           
            $ind_no = "MI_00".++$arr[1];

           // 
          }
          else {
            $ind_no = "MI_001" ;
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
                      $totalQualntity = floatval($totalQualntity) + floatval($value['quantity']);

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
              'category' => $value->materials->Category->category,
              'name' => $value->materials->name ,
              'brand' => $value->materials->brand ,
              'quantity' => $value->quantity,
              'comments' => $value->decription,
              'uom'=> $value->materials->uom,
              'features' => $value->materials->information

             ];
           }
          
          $pcn_data=Pcn::where('pcn',$idtend->pcn)->first();

         $pcn_detail = $pcn_data->client_name . " , ".$pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

          $empl = Employee::select('employee_id')->where('user_id',Auth::user()->id)->first();

           $indent_details = [
                 'indent_no' => $idtend->indent_no,
                 'pcn' => $idtend->pcn ,
                 'pcn_details'=> $pcn_detail ,
                 'creator' =>Auth::user()->name,
                 'details'=> $data ,
                 'creator_mail' => Auth::user()->email,
                 'employee_id' =>  $empl->employee_id   
          ];

           

          $subject = "New Material Indent " .$ind_no." ".$request->pcn;

          $emailarray = User::select('email')
                      ->whereIn('role_id',['1','2','3','4','5','10','11','12'])
                      ->where('status','Active')
                      ->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

           SendIndentEmail::dispatch($indent_details,$subject,$emailid);

          $footprint = FootPrint::create([
                  'action' => 'New indent created - '.$ind_no,
                  'user_id' => Auth::user()->id,
                  'module' => 'Indent',
                  'operation' => 'C'
              ]);

             
           $data= ['indent_no' =>$ind_no , 'pcn'=>$idtend->pcn , 'detail'=>$pcn_detail ];

          // die();

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
        $indents= Intend::where('indent_no',$id)->first();
        $indent_id = $indents->id ;
        $pcn = $indents->pcn ;
        $user = User::where('id',$indents->user_id)->first();

        $indents_list = Indent_list::withSum('grns','dispatched')->
             where('indent_id',$indent_id)->orderBy('material_id', 'ASC')->orderby('id','ASC')->paginate(25);

       // print_r(json_encode($indents_list));die();
         return view('indent/view_indents',compact('id' , 'indents_list' , 'pcn' ,'indents','user'));
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
       $total_grn = GRN::where('indent_list_id' , $id)->get();
       $total_dispatch = $total_grn->sum('dispatched');


      // print_r($dispatched);die();
       return view('indent/edit_indent_items',compact('indend_data' , 'id' , 'grn' ,'dispatched','total_dispatch'));
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

        $footprint = FootPrint::create([
                          'action' => 'GRN details modified - '.$request->grn,
                          'user_id' => Auth::user()->id,
                          'module' => 'GRN',
                          'operation' => 'U'
                      ]);

         return redirect()->route('edit_intends',$request->id)
                            ->withmessage('GRN Updated successfully');

       }
       else{
         return redirect()->route('edit_intends',$request->id)
                            ->withmessage('Failed to Update GRN');


       }

           

       
    }

   /* public function update_quantity(Request $request)
    {
       print_r("1 " .$request->Input());die();

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

    }*/

    public function update_dispatches(Request $request)
    {
        //   print_r($request->Input());die();

         if($request->quantity > $request->pending){
            return redirect()->route('edit_intends',$request->id)
                             ->withmessage("Dispatch Quantity should be less than Pending Quantity")
                             ->withInput();
         }

         else{

           $pcn_data =  Pcn::where('pcn',$request->pcn)->first();

           if($pcn_data->status == 'Completed'){
              return redirect()->route('edit_intends',$request->id)
                            ->withmessage($request->pcn.' is completed , you cannot dispatch any item');
           }

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

            $indent_list_details = Indent_list::where('id',$request->id)->first();
            $userdetail = Employee::where('user_id',$indent->user_id)->first();
            $subject = "Materials Dispatched : ".$GRN_id." - ".$request->indent_no." - ".$request->pcn." - ".$request->category;

             $grndata=[
              'grn' => $GRN_id,
              'owner' => $userdetail->name,
              'indent_no' => $request->indent_no,
              'material_id' => $indent_list_details->material_id,
              'category' => $indent_list_details->materials->Category->category,
              'material_name' => $indent_list_details->materials->name ,
              'dispatched' => $request->quantity.''.$indent_list_details->materials->uom,
              'creator_mail' => $userdetail->email
             ];

              $emailarray = User::select('email')
                          ->whereIn('role_id',['1','2','3','4','5','10','11','12'])
                          ->where('status','Active')
                          ->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

            
             // Mail::to($userdetail->email)->send(new GRNMail($grndata, $subject));
             SendDispatchEmail::dispatch($grndata,$subject,$emailid);

              $footprint = FootPrint::create([
                  'action' => 'GRN created- '.$GRN_id,
                  'user_id' => Auth::user()->id,
                  'module' => 'GRN',
                  'operation' => 'C'
              ]);
                     
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

    public function destroy_indent($id)
    {
        $delete = Intend::where('id', $id)->delete();

        if($delete){
          return redirect()->back();
        }
    }

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

            if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11 OR Auth::user()->role_id == 12) {
        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
       }
       elseif(Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5){

        $role = Roles::select('id')->where('team_id','3')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       elseif(Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 8 OR Auth::user()->role_id == 9){

        $role = Roles::select('id')->where('team_id','4')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       else {
        $indents=Intend::where('user_id' ,Auth::user()->id)->paginate(25);
        $all = Intend::where('user_id' ,Auth::user()->id)->count();
        $activeCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Active')->count();
      // $pendingCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Completed')->count();
       }


        }

        else {
         // print_r($filetr)

         /* if(Auth::user()->role_id == 4){
              $indents=Intend::where('user_id', Auth::user()->id)->where('status',$filter)->orderBy('id', 'DESC')->paginate(25);
            }
            else{
              $indents=Intend::where('status',$filter)->orderBy('id', 'DESC')->paginate(25);
            }*/
         if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11 OR Auth::user()->role_id == 12) {
        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
          ->where('status',$filter)
          ->orderBy('created_at', 'ASC')
          ->paginate(25);

        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
       }
       elseif(Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5){

        $role = Roles::select('id')->where('team_id','3')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
         ->whereIn('user_id',$userIDs)
         ->where('status',$filter)
         ->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       elseif(Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 8 OR Auth::user()->role_id == 9){

        $role = Roles::select('id')->where('team_id','4')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
        ->whereIn('user_id',$userIDs)
        ->where('status',$filter)
        ->orderBy('created_at', 'ASC')->paginate(25);

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
           

       }
       else {
        $indents=Intend::where('user_id' ,Auth::user()->id)->where('status',$filter)->paginate(25);
        $all = Intend::where('user_id' ,Auth::user()->id)->count();
        $activeCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Active')->count();
      // $pendingCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)->where('status','Completed')->count();
       }

             
        }


      /* if(Auth::user()->role_id == 4){
        $all = Intend::where('user_id', Auth::user()->id)->count();
        $activeCount = Intend::where('user_id', Auth::user()->id)->where('status','Active')->count();
        $pendingCount = Intend::where('user_id', Auth::user()->id)->where('status','Pending')->count();
        $compltedCount = Intend::where('user_id', Auth::user()->id)->where('status','Completed')->count();
      }
      else{
        $all = Intend::count();
        $activeCount = Intend::where('status','Active')->count();
        $pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::where('status','Completed')->count();
      }*/
        //print_r($pendingCount);

      $search = '';
      $filtr = $filter;

         return view('indent/list' , compact('indents' , 'all' , 'activeCount' , 'compltedCount','search','filtr'));
      
    }

    /*public function action(Request $request){
     
        $search = $request->search;
        $search_array = explode(' ', $search);
        $product = array();
        $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"));
  
        foreach ($search_array as $key => $value) {

          if($key == '0'){
           $search = $value;
           $first = $value ;
            
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

        $product=$product->get();

        return response()->json($product);
    }*/

    public function grn(){

        $grns = GRN::where('user_id',Auth::user()->id)
               ->orWhere('delegated_id',Auth::user()->id)
               ->orderByRaw("FIELD(status , 'Awaiting for Confirmation', 'Received') ASC")
               ->paginate(25);
        $grn_array = array();
        $search = '';

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
              'uom' => $material->uom

            ];

             $grs_data = [
              'date' => $value->created_at,
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'comment' => $value->dispatch_comment,
              'status'=> $value->status,
              'indent_details' => array($material_detail),
              'delegated_id' => $value->delegated_id
            ];

            array_push($grn_array, $grs_data);
          }

         
          }
           return view('indent/grn',compact('grn_array','grns','search'));
    }

    public function update_grn(Request $request){

      //  print_r($request->Input());die();

        $update_grn_data = GRN::where('grn',$request->grn)->update([
                                       'approved'=> $request->approved,
                                       'damaged' => floatval($request->dispatched)-floatval($request->approved),
                                       'comment' => $request->comment,
                                       'status' => 'Received'
                                      ]);
        if($update_grn_data){
         
           $GRNdata = GRN::select('indent_list_id', 'indent_no')->where('grn',$request->grn)->first();

           $indent_list = Indent_list::where('id',$GRNdata->indent_list_id)->first();
            
            $pending = floatval($indent_list->pending)-floatval($request->approved);
            $received = floatval($indent_list->recieved)+floatval($request->approved);

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

            $pending = floatval($indent_data->pending)-floatval($request->approved);
            $received = floatval($indent_data->recieved)+floatval($request->approved);

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
            
            $footprint = FootPrint::create([
                    'action' => 'GRN accepted - '.$request->grn,
                    'user_id' => Auth::user()->id,
                    'module' => 'GRN',
                    'operation' => 'U'
                ]);


            return redirect()->route('grn');

            
               
            }

             

        }
        else {
          return redirect()->back()->withMessage('Could not update GRN');

        }

    }

    public function search(Request $request){
     
        $search = $request->search;
        // print_r($search); die();
        $filtr = $request->filter;

        if($filtr == 'all'){
          $filtr = '';
        }
         
        if($search == ''){
          return redirect()->route('intends');
        } 

        if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11 OR Auth::user()->role_id == 12) {

          $indents=Intend::where('status','LIKE',$filtr.'%')
              ->where(function($query)use($search){
                $query->where('indent_no','LIKE','%'.$search.'%');
                $query->orWhere('pcn','LIKE','%'.$search.'%');
                $query->orWhereDate('created_at','LIKE','%'.$search.'%');
                $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
                $query->orWhereYear('created_at','LIKE','%'.$search.'%');
                $query ->orWhereHas('pcns', function ($query2) use ($search) {
                    $query2->where('brand', 'like', '%'.$search.'%');
                 });
                })
              
              ->orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
              ->paginate(25)->withQueryString();

          $all = Intend::count();
          $activeCount = Intend::where('status','Active')->count();
          //$pendingCount = Intend::where('status','Pending')->count();
          $compltedCount = Intend::where('status','Completed')->count();

        }
        elseif(Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5){
           $role = Roles::select('id')->where('team_id','3')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
             ->whereIn('user_id',$userIDs)
             ->where('status','LIKE',$filtr.'%')
             ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
              $query->orWhere('pcn','LIKE','%'.$search.'%');
              $query->orWhereDate('created_at','LIKE','%'.$search.'%');
              $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
              $query->orWhereYear('created_at','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
             ->orderBy('created_at', 'ASC')
             ->paginate(25)->withQueryString();

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
        }

        elseif(Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 8 OR Auth::user()->role_id == 9){

          $role = Roles::select('id')->where('team_id','4')->get();
            $emp= array();
            foreach ($role as $key => $value) {
               $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

               foreach ($emp as $key2 => $value2) {
                 $userIDs[] = $value2->user_id;
             }
              
            }

        $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
            ->whereIn('user_id',$userIDs)
            ->where('status','LIKE',$filtr.'%')
            ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
               $query->orWhere('pcn','LIKE','%'.$search.'%');
               $query->orWhereDate('created_at','LIKE','%'.$search.'%');
               $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
               $query->orWhereYear('created_at','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
            ->orderBy('created_at', 'ASC')
            ->paginate(25)->withQueryString();

        $all = Intend::whereIn('user_id',$userIDs)->count();
        $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
        //$pendingCount = Intend::where('status','Pending')->count();
        $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();

        }
        else{
        $indents=Intend::where('user_id' ,Auth::user()->id)
        ->where('status','LIKE',$filtr.'%')
        ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
               $query->orWhere('pcn','LIKE','%'.$search.'%');
               $query->orWhereDate('created_at','LIKE','%'.$search.'%');
               $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
               $query->orWhereYear('created_at','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
        ->paginate(25)->withQueryString();

        $all = Intend::where('user_id' ,Auth::user()->id)
        ->count();

        $activeCount = Intend::where('user_id' ,Auth::user()->id)
        ->where('status','Active')->count();
     
        $compltedCount = Intend::where('user_id' ,Auth::user()->id)
        ->where('status','Completed')->count();
        }

       $search = $request->search ;
       $filtr = ($filtr == '')?'all':$filtr;
       return view('indent/list' , compact('indents' , 'all' , 'activeCount' , 'compltedCount','search','filtr'));            

    }

    public function search_grn(Request $request){
      $search = $request->search ;
      if($request->search == ''){
          return redirect()->route('grn');
      }
      else{
      $grns = GRN::where(function($q){
                 $q->where('user_id',Auth::user()->id);
                 $q->orWhere('delegated_id',Auth::user()->id);
              })
     
              ->where(function($query)use($search){
                 $query->where('grn', 'LIKE','%'.$search.'%');
                 $query->orWhere('pcn', 'LIKE' ,'%'.$search.'%');
                 $query->orWhere('indent_no', 'LIKE' ,'%'.$search.'%');
                 $query->orWhereDate('created_at','LIKE','%'.$search.'%');
                 $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
                 $query->orWhereYear('created_at','LIKE','%'.$search.'%');

              })
              ->orderBy('id', 'DESC')
              ->paginate(25);
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
              'uom' => $material->uom

            ];

             $grs_data = [
              'date' => $value->created_at,
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'comment' => $value->dispatch_comment,
              'status'=> $value->status,
              'indent_details' => array($material_detail),
              'delegated_id' => $value->delegated_id
            ];
            
            array_push($grn_array, $grs_data);
          }
            
         
          }
          else {
              $grn_array=array();
          
          }

           return view('indent/grn',compact('grn_array','grns','search'));
    }
  }

  public function update_indent_status($id){

      $update = Intend::where('indent_no' , $id) ->update(['status' => 'Completed']);

      if($update){
        $footprint = FootPrint::create([
                    'action' => 'Indent status updated - '.$id,
                    'user_id' => Auth::user()->id,
                    'module' => 'Indent',
                    'operation' => 'U'
                ]);

        return redirect()->route('intends');
      }

  }

  public function filter_materials(Request $request){
   // print_r($request->search); 

    $search = $request->search;
    $search_array = explode(',', $search);
    $product = array();
    $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"));
  
        foreach ($search_array as $key => $value) {

          if($key == '0'){
           $search = $value;
            
           $product = $product->where(function($query)use($search){
            $query->orWhere('item_code' , 'LIKE', '%'.$search.'%');
            $query->orWhere('name' , 'LIKE', '%'.$search.'%');
            $query->orWhere('brand' , 'LIKE', '%'.$search.'%');
            $query->orWhere('information' , 'LIKE', '%'.$search.'%');

        });
        

          }
          else if($key > '0'){
          $search = $value;

           $product = $product->where(function($query)use($search){
            $query->orWhere('item_code' , 'LIKE', '%'.$search.'%');
            $query->orWhere('name' , 'LIKE', '%'.$search.'%');
            $query->orWhere('brand' , 'LIKE', '%'.$search.'%');
            $query->orWhere('information' , 'LIKE', '%'.$search.'%');

            });
           
          }
         
         
        }

        $product=$product->get();
       
      return response()->json($product);

   // print_r(sizeof($product)); die();    

  }

  public function trigger_settlement(Request $request){
   // print_r($request->Input()); die();

    if(GRN::where('indent_no',$request->indent_no)->where('status' ,'Awaiting for Confirmation')->exists()){
      return redirect()->back()->withMessage('There is pending GRN .You cannot trigger for Endorse settle ');
    }

    $update =  Intend::where('indent_no', $request->indent_no)->update(
      [
       'settlement_triggerd' => 'YES' , 
       'trigger_comments' => $request->comment ,
       'commenter_id' => Auth::user()->id
     ]);

    if($update){

      $footprint = FootPrint::create([
                    'action' => 'Indent endorse triggered - '.$request->indent_no,
                    'user_id' => Auth::user()->id,
                    'module' => 'Indent',
                    'operation' => 'U'
                ]);

      return redirect()->back();
    }


  }

  public function settle_indent(Request $request){
     $update =  Intend::where('indent_no', $request->indent_no)->update(
      [
       'indent_settled' => 'YES' , 
       'settled_comments' => $request->comment ,
       'settler_id' => Auth::user()->id,
       'status' => 'Completed'
     ]);

     if($update){
      $footprint = FootPrint::create([
                    'action' => 'Indent settled - '.$request->indent_no,
                    'user_id' => Auth::user()->id,
                    'module' => 'Indent',
                    'operation' => 'U'
                ]);

        return redirect()->back();
      }
    
  }

   public function export_pdf($ind_no){
   // print_r($ind_no); die();
     $idtend= Intend::where('id',$ind_no)->first();
     $pdf_array = Indent_list::where('indent_id' , $idtend->id)->with('materials')->get();

     foreach ($pdf_array as $key => $value) {

       $data[] = [
        'material_id' => $value->material_id ,
        'category' => $value->materials->Category->category,
        'name' => $value->materials->name ,
        'brand' => $value->materials->brand ,
        'quantity' => $value->quantity,
        'comments' => $value->decription,
        'uom'=> $value->materials->uom,
        'features' => $value->materials->information

       ];
     }
    
    $pcn_data=Pcn::where('pcn',$idtend->pcn)->first();
    $empl = Employee::where('user_id',$idtend->user_id)->first();

    $pcn_detail = $pcn_data->client_name . " , ".$pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

     $indent_details = [
                 'indent_no' => $idtend->indent_no,
                 'pcn' => $idtend->pcn ,
                 'pcn_details'=> $pcn_detail ,
                 'creator' =>$empl->name,
                 'details'=> $data ,
                 'creator_mail' => $empl->email,
                 'employee_id' =>  $empl->employee_id     
          ];

     $pdf = PDF::loadView('pdf/indentsPDF',compact('indent_details'));
     $filename = 'exported_indent.pdf';
    
     $savepdf = $pdf->save(public_path($filename));   
     return $pdf->download($filename);  

   }

   public function product_details(Request $request){

        $search = $request->search;
       
        $product = array();
        
        if(isset($request->code)){
           if(Material::where('item_code',$request->code)->exists()){
             $product = Material::where('item_code',$request->code)->first();
             $resp = ['item' => $product,
                      'input' => "code"
                    ];
           }
           else{
            
              $resp = ['item' => $product,
                      'input' => "code"
                    ];
           }
  
          return response()->json($resp);
        }
        else if(isset($request->name) && isset($request->brand) &&  isset($request->feature) ){
        
       // $search_array = explode(' ', $search);
       /* $name = $request->name ;
        $brand = $request->brand;
        $feature = $request->feature ;*/

        $name = 'Sand' ;
        $brand = 'gen';
        $feature = 'd';

        $product =  array();
        $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"));

        $product = $product->where('name' , 'LIKE', '%'.$name.'%')
                   ->where('brand' , 'LIKE', '%'.$brand.'%') 
                   ->where(DB::raw('lower(information)'), 'like', '%' . strtolower($feature) . '%')
                   ->get();       


         $resp = ['item' => $product,
                  'input' => "search"
                  ];

        return response()->json($product);
      }

   }

   public function action(Request $request){
     
        $search = $request->search;
        $search_array = explode(',', $search);
        $product = array();
        $product =  Material::select('*',DB::raw("CONCAT(item_code,' - ',name,' - ',brand ,' - ',information) AS value"));

        $size = sizeof($search_array);
  
        foreach ($search_array as $key => $value) {

          if($key == '0'){
           $search = $value;
           $first = $value ;
            
           $product = $product->where(function($query)use($search){
            $query->where('name' , 'LIKE', '%'.$search.'%');
           });
        

          }
          else if($key == '1'){
          $search = $value;

           $product = $product->where(function($query)use($search){
            $query->where('brand' , 'LIKE', '%'.$search.'%');  
            });
           
          }
          else if($key == '2'){
           $search = $value;

           $product = $product->where(function($query)use($search){
             $query->where(DB::raw('lower(information)'), 'LIKE','%'. strtolower($search).'%');
           // $query->orWhere('information' , 'LIKE', '%'.$search.'%');

            });
            
          }
          else if($key > '2'){
           $search = $value;

           $product = $product->where(function($query)use($search){
             $query->where(DB::raw('lower(information)'), 'LIKE','%'. strtolower($search).'%');
           // $query->orWhere('information' , 'LIKE', '%'.$search.'%');

            });
            
          }
         
         
        }

        $product=$product->get();

        return response()->json($product);
    }

    public function grn_list(){
      $search = '';
      $grns = GRN::where('status','Awaiting for Confirmation')->paginate(25);
      $employee = Employee::get();

      return view('indent.grn_list',compact('grns','employee','search'));
    }

    public function deligate_grn(Request $request){
      //print_r($request->input());die();

      $deleigate = GRN::where('id',$request->grn_id)->where('grn',$request->grn)->update(['delegated_id' => $request->user_id , 'delegator' => Auth::user()->id]);

      if($deleigate){

        $empl = Employee::where('user_id',$request->user_id)->first();

        $footprint = FootPrint::create([
            'action' => $request->grn .' Delegated to '.$empl->name.' - '.$empl->employee_id,
            'user_id' => Auth::user()->id,
            'module' => 'Indent',
            'operation' => 'U'
        ]);
        return redirect()->back();
      }

    }

    public function search_deligation_grn(Request $request){

      $search = $request->search;

      if($search == ''){
        return redirect()->route('grn_list');
      }
      $grns = GRN::where('status','Awaiting for Confirmation')
             ->where(function($query)use($search){
                 $query->where('grn', 'LIKE','%'.$search.'%');
                 $query->orWhere('pcn', 'LIKE' ,'%'.$search.'%');
                 $query->orWhere('indent_no', 'LIKE' ,'%'.$search.'%');
                 $query->orWhereDate('created_at','LIKE','%'.$search.'%');
                 $query->orWhereMonth('created_at','LIKE','%'.$search.'%');
                 $query->orWhereYear('created_at','LIKE','%'.$search.'%');

              })
              ->paginate(25);
      $employee = Employee::get();

      return view('indent.grn_list',compact('grns','employee','search'));
    }
}

