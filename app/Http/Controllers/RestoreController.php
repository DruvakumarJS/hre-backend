<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;
use App\Models\User;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Material;

class RestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	return view('restore/list');
    }

    public function customer_list(){
    	$data = Customer::onlyTrashed()->paginate(20);

    	return view('restore/customers' , compact('data'));

    	
    }

    public function restore_customer($id){

    	$restor = Customer::where('id',$id)->restore();

    	if($restor){
    		return redirect()->back();
    	}

    }

    public function trash_customer($id){

    	$forcedelete = Customer::where('id',$id)->forceDelete();

    	if($forcedelete){
            $deleteCustomerAddress = Address::where('customer_id', $id)->delete();
            if($deleteCustomerAddress){
                return redirect()->back();
            }
    		
    	}

    }

    public function users_list(){
    	$data = Employee::onlyTrashed()->paginate(20);

    	return view('restore/users' , compact('data'));
    	
    }

    public function restore_user($id){

        $restor = Employee::where('user_id',$id)->restore();

        if($restor){
            $restoruser = User::where('id',$id)->restore();

            if($restoruser){
                return redirect()->back();
            }
            
        }

    }

    public function trash_user($id){

        $trash = Employee::where('user_id',$id)->forceDelete();

        if($trash){
            $trashuser = User::where('id',$id)->forceDelete();

            if($trashuser){
                return redirect()->back();
            }
            
        }

    }

     public function category_list(){
        $data = Category::onlyTrashed()->paginate(20);

        return view('restore/categories' , compact('data'));
        
    }

    public function restore_category($id){

        $restor = Category::where('code',$id)->restore();

        if($restor){
             return redirect()->back();
            
        }

    }

    public function trash_category($id){

        $delete = Category::where('code',$id)->forceDelete();

        if($delete){
             return redirect()->back();
            
        }

    }

     public function material_list(){
        $data = Material::onlyTrashed()->paginate(20);

        return view('restore/materials' , compact('data'));
        
    }

   public function restore_material($id){

        $restor = Material::where('id',$id)->restore();

        if($restor){
             return redirect()->back();
            
         }

    }

    public function trash_material($id){

        $restor = Material::where('id',$id)->forceDelete();

        if($restor){
             return redirect()->back();
            
         }

    }





}
