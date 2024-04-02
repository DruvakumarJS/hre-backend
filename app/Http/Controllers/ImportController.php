<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Excel;
use App\Imports\ImportUser;
use App\Imports\ImportCustomer;
use App\Imports\ImportMaterial;
use App\Imports\ImportCategory;
use App\Imports\ImportVendor;
use App\Models\FootPrint;
use Auth;

class ImportController extends Controller
{
    public function importuser(Request $request){

        $import = new ImportUser ;

    	Excel::import($import, $request->file('file'));
        
        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
             $footprint = FootPrint::create([
                    'action' => $import->getRowCount().' User(s) added to the list via import option',
                    'user_id' => Auth::user()->id,
                    'module' => 'User',
                    'operation' => 'C'
                ]);
            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' User(s) added .');
        }
    }

     public function importcustomer(Request $request){
        $import = new ImportCustomer ;

    	Excel::import($import, $request->file('file'));

        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
             $footprint = FootPrint::create([
                    'action' => $import->getRowCount().' Customer(s) added to the list via import option',
                    'user_id' => Auth::user()->id,
                    'module' => 'Customer',
                    'operation' => 'C'
                ]);
            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' Customer(s) added .');
        }
        
    }

     public function importcategory(Request $request){

        $import = new ImportCategory ;

    	Excel::import($import, $request->file('file'));
        
        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
             $footprint = FootPrint::create([
                    'action' => $import->getRowCount().' Material Category added to the list via import option',
                    'user_id' => Auth::user()->id,
                    'module' => 'Material Category',
                    'operation' => 'C'
                ]);
            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' Material Category added .');
        }
    }

     public function importmaterial(Request $request){

     
        $import = new ImportMaterial ;

    	Excel::import($import, $request->file('file'));

        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
             $footprint = FootPrint::create([
                    'action' => $import->getRowCount().' product(s) added to the list via import option',
                    'user_id' => Auth::user()->id,
                    'module' => 'Products',
                    'operation' => 'C'
                ]);
            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' product(s) added .');
        }
        //return redirect()->back();
    }

     public function importvendor(Request $request){

        $import = new ImportVendor ;

        Excel::import($import, $request->file('file'));

        if($import->getRowCount() == 0){
            return redirect()->back()->withMessage('No data imported');
        }
        else {
             $footprint = FootPrint::create([
                    'action' => $import->getRowCount().' vendor(s) added to the list via import option',
                    'user_id' => Auth::user()->id,
                    'module' => 'Vendor ',
                    'operation' => 'C'
                ]);

            return redirect()->back()->withMessage('Import Successfull. '.$import->getRowCount() . ' vendor(s) added .');
        }

        return redirect()->back();
    }

}
