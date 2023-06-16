<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB ;

class ExportMaterial implements FromCollection , WithHeadings
{
    private $filter ; 
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($filter) 
    {
        $this->filter = $filter;
    }    

    public function collection()
    {
        if($this->filter=="all"){
            $material =  DB::table('materials')->select('created_at','item_code', 'category_id' , 'name' , 'brand' , 'uom' , 'information')->get();

        }
        else{
            $material =  DB::table('materials')->select('item_code', 'category_id' , 'name' , 'brand' , 'uom' , 'information')->where('category_id',$this->filter)->get();
        }

        return $material ;
        
    }

    public function headings(): array
    {
    	return ['Date','Material Code' , 'Category ID' , 'Material Name' , 'Brand' , 'UoM' , 'More info'];

    }
}
