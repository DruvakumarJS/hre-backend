<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Excel;
use App\Imports\ImportUser;
use App\Imports\ImportCustomer;
use App\Imports\ImportMaterial;
use App\Imports\ImportCategory;

class ImportController extends Controller
{
    public function importuser(Request $request){

    	Excel::import(new ImportUser, $request->file('file'));
        return redirect()->back();
    }

     public function importcustomer(Request $request){

    	Excel::import(new ImportCustomer, $request->file('file'));
        return redirect()->back();
    }

     public function importcategory(Request $request){

    	Excel::import(new ImportCategory, $request->file('file'));
        return redirect()->back();
    }

     public function importmaterial(Request $request){

     
        $import = new ImportMaterial ;

    	Excel::import($import, $request->file('file'));

        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' materials added .');
        }
        //return redirect()->back();
    }
}
