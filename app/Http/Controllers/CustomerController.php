<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Pcn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportCustomer;
use Excel;


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
        $customers = Customer::with('address')->orderBy('id', 'DESC')->paginate(10);
        return view('customer/list',compact('customers'));
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
       // print_r($request->Input()); die();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'mobile' => 'required|min:10|max:10|unique:customers',
            'email' => 'required|email|unique:customers',    
        ]);


       if ($validator->fails()) {
              return redirect()->route('create_customer')
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else{
           
           $customer = Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile ,
            'mobile1' => $request->mobile1 ,
            'mobile2' => $request->mobile2 ,
            'mobile3' => $request->mobile3 ,
            'email' => $request->email ,
            'email1' => $request->email1 ,
            'email2' => $request->email2 ,
            'email3' => $request->email3 ,
           
           ]);

           if($customer){

            $customer_id = Customer::select('id')->where('email',$request->email)->first();

            $customer_address =  $request->address ;

            foreach ($customer_address as $key => $value) {
               $addres = Address::create([
                'customer_id'=> $customer_id->id ,
                'brand' => $value['brand'] , 
                'state' => $value['state'] ,
                'gst' => $value['gst'] 

               ]);
            } 

        
           }

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

        $update_customer = Customer::where('id', $request->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile ,
            'mobile1' => $request->mobile1 ,
            'mobile2' => $request->mobile2 ,
            'mobile3' => $request->mobile3 ,
            'email' => $request->email ,
            'email1' => $request->email1 ,
            'email2' => $request->email2 ,
            'email3' => $request->email3 ,
           
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

        $deleteAddress = Address::where('id',$request->id)->delete();

        if($deleteAddress){
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

             $deleteCustomer = Customer::find($id)->delete();

                if($deleteCustomer){
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
    $customers = Customer::where('name' , 'LIKE', '%'.$request->search.'%')
    ->orWhere('email' , 'LIKE', '%'.$request->search.'%')
    ->orWhere('mobile' ,'LIKE', '%'.$request->search.'%')
    ->orderBy('id', 'DESC')
    ->paginate(10);

        return view('customer/list',compact('customers'));
    }

   
}
