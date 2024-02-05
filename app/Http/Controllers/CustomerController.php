<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportCustomer;
use Excel;
use App\Mail\CustomerMail;
use Mail;
use App\Jobs\SendCustomerEmail;
use App\Models\FootPrint;
use Auth;


class CustomerController extends Controller
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
        $customers = Customer::with('address')->orderBy('id', 'DESC')->paginate(25);
       
        $search = '';

        return view('customer/list',compact('customers' , 'search'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/create_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->Input()); die();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
               
        ]);



       if ($validator->fails()) {
              return redirect()->route('create_customer')
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else{
           
          /* $customer = Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile1 ,
            'mobile1' => $request->mobile2 ,
            'mobile2' => $request->mobile3 ,
            'mobile3' => $request->mobile4 ,
            'email' => $request->email1 ,
            'email1' => $request->email2 ,
            'email2' => $request->email3 ,
            'email3' => $request->email4 ,
            'full_name' => $request->full_name1,
            'designation' => $request->designation1,
            'full_name1' => $request->full_name2,
            'designation1' => $request->designation2,
            'full_name2' => $request->full_name3,
            'designation2' => $request->designation3,
            'full_name3' => $request->full_name4,
            'designation3' => $request->designation4,
           
           ]);*/

           $customer = new Customer ;
           $customer->name = $request->name ;
           $customer->mobile = $request->mobile1 ;
           $customer->mobile1 = $request->mobile2 ;
           $customer->mobile2 = $request->mobile3 ;
           $customer->mobile3 = $request->mobile4 ;
           $customer->email = $request->email1 ;
           $customer->email1 = $request->email2 ;
           $customer->email2 = $request->email3 ;
           $customer->email3 = $request->email4 ;
           $customer->full_name = $request->full_name1 ;
           $customer->designation = $request->designation1 ;
           $customer->full_name1 = $request->full_name2 ;
           $customer->designation1 = $request->designation2 ;
           $customer->full_name2 = $request->full_name3 ;
           $customer->designation2 = $request->designation3 ;
           $customer->full_name3 = $request->full_name4 ;
           $customer->designation3 = $request->designation4 ;
           
           $customer->save();

           $customer_id = $customer->id ;

            //$customer_id = Customer::select('id')->where('name',$request->name)->first();
           
           if($customer_id != 0 || $customer_id != ''){
            $customer_address =  $request->address ;

            foreach ($customer_address as $key => $value) {
               $addres = Address::create([
                'customer_id'=> $customer_id ,
                'brand' => $value['brand'] , 
                'state' => $value['state'] ,
                'gst' => $value['gst'] 

               ]);
            } 

        
          }
       
          $subject = "New Customer Added";
           $empl = Employee::where('user_id',Auth::user()->id)->first();
          $details =[ 'name' => $request->name,
            'mobile' => $request->mobile1,
            'mobile1' => $request->mobile2 ,
            'mobile2' => $request->mobile3 ,
            'mobile3' => $request->mobile4 ,
            'email' => $request->email1 ,
            'email1' => $request->email2 ,
            'email2' => $request->email3 ,
            'email3' => $request->email4 ,
            'full_name' => $request->full_name1,
            'designation' => $request->designation1,
            'full_name1' => $request->full_name2,
            'designation1' => $request->designation2,
            'full_name2' => $request->full_name3,
            'designation2' => $request->designation3,
            'full_name3' => $request->full_name4,
            'designation3' => $request->designation4,
            'employee_name' => $empl->name,
            'employee_id' => $empl->employee_id ]; 


            
          $data = ['details' =>$details  ,'address' => $customer_address ];
          $action = 'Create';

             $emailarray = User::select('email')->whereIn('role_id',['1','2','3','4','6','7','10','11'])->get();
               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

         // Mail::to($emailid)->send(new CustomerMail($data,$subject));
           SendCustomerEmail::dispatch($data , $subject , $emailid , $action);

         $footprint = FootPrint::create([
                    'action' => 'New Customer created - '.$request->name,
                    'user_id' => Auth::user()->id,
                    'module' => 'Customer',
                    'operation' => 'C'
                ]);
             
              return redirect()->route('view_customers');
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $customer = Customer::where('id', $id)->with('address')->first();
       return view('customer/edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // echo '<pre>';
       
       // print_r($request->Input());die();

        if(isset($request->address)){

           $cust_data = Customer::where('id', $request->id)->with('address')->first();

          // print_r($cust_data->name); die();
           
          // print_r(json_encode($cust_data)); die();
        
        $update_customer = Customer::where('id', $request->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile1,
            'mobile1' => $request->mobile2 ,
            'mobile2' => $request->mobile3 ,
            'mobile3' => $request->mobile4 ,
            'email' => $request->email1 ,
            'email1' => $request->email2 ,
            'email2' => $request->email3 ,
            'email3' => $request->email4 ,
            'full_name' => $request->full_name1,
            'designation' => $request->designation1,
            'full_name1' => $request->full_name2,
            'designation1' => $request->designation2,
            'full_name2' => $request->full_name3,
            'designation2' => $request->designation3,
            'full_name3' => $request->full_name4,
            'designation3' => $request->designation4,
           
            ]);

        if($update_customer){

            foreach ($request->address as $key => $value) {

                if(isset($value['brand']) && isset($value['state']) && isset($value['gst']) ){

                if(isset($value['id'])){

                     if(Address::where('id',$value['id'])->first()->exists()){
                  $update=Address::where('id',$value['id'])->update([
                    'brand' => $value['brand'] ,
                    'state' => $value['state'],
                    'gst' => $value['gst']]);
               }
               else {
               
                $addres = Address::create([
                    'customer_id'=> $request->id ,
                    'brand' => $value['brand'] ,
                    'state' => $value['state'],
                    'gst' => $value['gst']   

               ]);

               }

               }
               else {

                $addres = Address::create([
                    'customer_id'=> $request->id,
                    'brand' => $value['brand'] ,
                    'state' => $value['state'],
                    'gst' => $value['gst']  ]); 

                }
              }

             
                
            }

            
        }
          $customer_address=$request->address;
          $subject = "Customer Details - Modified";
          $empl = Employee::where('user_id',Auth::user()->id)->first();
          $details =[ 'name' => $request->name,
            'mobile' => $request->mobile1,
            'mobile1' => $request->mobile2 ,
            'mobile2' => $request->mobile3 ,
            'mobile3' => $request->mobile4 ,
            'email' => $request->email1 ,
            'email1' => $request->email2 ,
            'email2' => $request->email3 ,
            'email3' => $request->email4 ,
            'full_name' => $request->full_name1,
            'designation' => $request->designation1,
            'full_name1' => $request->full_name2,
            'designation1' => $request->designation2,
            'full_name2' => $request->full_name3,
            'designation2' => $request->designation3,
            'full_name3' => $request->full_name4,
            'designation3' => $request->designation4 ,
            'employee_name' => $empl->name,
            'employee_id' => $empl->employee_id ]; 

        
         $data = ['details' =>$details  ,'address' => $customer_address ,  'old_data'=> $cust_data];
         $action = 'Update';
          /*$data = ['name' => $request->name , 'mobile'=>$request->mobile , 'email'=>$request->email ,'address' => $customer_address , 'old_data'=> $cust_data];*/

            $emailarray = User::select('email')->where('role_id','!=','13')->where('role_id','!=','14')->get();
               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }
               
           // Mail::to($emailid)->send(new CustomerMail($data,$subject));

               SendCustomerEmail::dispatch($data , $subject , $emailid ,$action);

                $footprint = FootPrint::create([
                    'action' => 'Customer details modified - '.$cust_data->name,
                    'user_id' => Auth::user()->id,
                    'module' => 'Customer',
                    'operation' => 'U'
                ]);
             
               return redirect()->route('view_customers');

      }
      else{
         return redirect()->Back()->withmessage('Please add atleast one address');
      }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function delete_address(Request $request)
    {
     //  print_r($request->Input());die();

       // $delete = Address::();
        //echo 'RESP='.$request->input('id');exit;
        $data = Address::where('id',$request->id)->first();
        $deleteAddress = Address::where('id',$request->id)->delete();

        if($deleteAddress){

            $footprint = FootPrint::create([
                            'action' => 'Customer address/brand deleted- '.$data->brand,
                            'user_id' => Auth::user()->id,
                            'module' => 'Customer',
                            'operation' => 'D'
                        ]);

            return response()->json([
                'status'=>1,
                'message'=> 'deleted' ]);
        } 
        else {
             return response()->json([
                'status'=>0,
                'message'=> 'fail' ]);

        }

       
    }

    public function delete_customer($id){
       
        if(Pcn::where('customer_id', $id)->exists()){
            return redirect()->route('view_customers')->withmessage('The Customer has PCN data, You cannot delete the Customer');

        }
        else {
             $Customer = Customer::find($id)->first();
             $name = $Customer->name ;
             $deleteCustomer = Customer::find($id)->delete();

                if($deleteCustomer){
                    
                    $footprint = FootPrint::create([
                            'action' => 'Customer deleted - '.$name,
                            'user_id' => Auth::user()->id,
                            'module' => 'Customer',
                            'operation' => 'D'
                        ]);

                    return redirect()->route('view_customers')->withmessage('Sucessfully Deleted ');
                }
                else{
                    return redirect()->route('view_customers')->withmessage('Something went wrong');


                }
            /*$deleteCustomerAddress = Address::where('customer_id', $id)->delete();
            if($deleteCustomerAddress){
                $deleteCustomer = Customer::where('id', $id)->delete();

                if($deleteCustomer){
                    return redirect()->route('view_customers')->withmessage('Sucessfully Deleted ');
                }
                else{
                    return redirect()->route('view_customers')->withmessage('Something went wrong');


                }
            }
            else {
                return redirect()->route('view_customers')->withmessage('Could not delete address');

            }*/

        }


    }

    public function search(Request $request){
       
        if($request->search == ''){
          return redirect()->route('view_customers');
        }

    $search = $request->search ;
    $customers = Customer::where('name' , 'LIKE', '%'.$request->search.'%')
    ->orWhere('email' , 'LIKE', '%'.$request->search.'%')
    ->orWhere('mobile' ,'LIKE', '%'.$request->search.'%')
    ->orderBy('id', 'DESC')
    ->paginate(25);

        return view('customer/list',compact('customers','search'));
    }

   
}
