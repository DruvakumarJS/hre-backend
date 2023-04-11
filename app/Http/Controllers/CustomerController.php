<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('address')->paginate(10);
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
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'mobile' => 'required|min:10|unique:customers',
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
            'brand' => $request->brand,
            'mobile' => $request->mobile ,
            'email' => $request->email ,
            'telephone' => $request->tel, 
           ]);

           if($customer){

            $customer_id = Customer::select('id')->where('email',$request->email)->first();

            $customer_address =  $request->address ;

            foreach ($customer_address as $key => $value) {
               $addres = Address::create([
                'customer_id'=> $customer_id->id ,
                'area' => $value['area'] , 
                'city' => $value['city'] , 
                'state' => $value['state']   

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
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
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
}
