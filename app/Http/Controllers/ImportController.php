<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;

class ImportController extends Controller
{
    public function importuser(Request $request){

    	Excel::import(new ImportUser, $request->file('file'));
        return redirect()->back();
    }
}
