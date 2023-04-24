<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCategory implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     private $id;
     private $code;
     private $category;
     private $material_category;

    /* public function __construct($id, $code, $category , $material_category) 
    {
        $this->id = $id;
        $this->code = $code;
        $this->category = $category;
        $this->material_category = $material_category;
    }*/

    public function collection()
    {
        return Category::select('code', 'category', 'material_category')->get();
    }

     public function headings(): array
     {       
       return [
        'Category code', 'Category','Category ID' 
       ];
     }
}
