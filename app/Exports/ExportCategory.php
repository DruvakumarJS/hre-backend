<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB; 
class ExportCategory implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    /* public function __construct($id, $code, $category , $material_category) 
    {
        $this->id = $id;
        $this->code = $code;
        $this->category = $category;
        $this->material_category = $material_category;
    }*/

    public function collection()
    {
        $cat= DB::table('categories')->select(DB::raw("DATE_FORMAT(`created_at`, '%d-%m-%Y') as date"),'category', 'material_category')->get();
        return $cat ;
    }

     public function headings(): array
     {       
       return [
         'Date','Category','Category code' 
       ];
     }
}
