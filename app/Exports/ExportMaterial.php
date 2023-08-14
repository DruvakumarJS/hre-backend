<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB ;

class ExportMaterial implements FromCollection , WithHeadings
{
    private $filter ; 
    private $start;
    private $end;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($filter , $start , $end) 
    {
        $this->filter = $filter;
        $this->start = $start ;
        $this->end = $end ;
    }    

    public function collection()
    {
         $search = $this->filter;
         $start = $this->start;
         $end = $this->end;

        if($this->filter=="all"){
            $material =  DB::table('materials')
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%d-%m-%Y') as date"),'item_code', 'category_id' , 'name' , 'brand' , 'uom' , 'information')
            ->whereBetween('created_at', [$this->start , $this->end])
            ->get();

        }
        else if($search != ''){
           
            $material =  DB::table('materials')
            ->select('item_code', 'category_id' , 'name' , 'brand' , 'uom' , 'information')
            ->where('item_code', 'LIKE','%'.$search.'%')
            ->orWhere('name', 'LIKE','%'.$search.'%')
            ->orWhere('brand', 'LIKE','%'.$search.'%')
            ->orWhere('uom', 'LIKE','%'.$search.'%')
            ->orWhere('information', 'LIKE','%'.$search.'%')
            ->where(function ($query) {
                $query->whereBetween('created_at', [$this->start , $this->end]);

            })
            ->get();
        }
        else {
             $material =  DB::table('materials')
            ->select('item_code', 'category_id' , 'name' , 'brand' , 'uom' , 'information')
            ->whereBetween('created_at', [$this->start , $this->end])
            ->get();
        }

        return $material ;
        
    }

    public function headings(): array
    {
    	return ['Date','Material Code' , 'Category ID' , 'Material Name' , 'Brand' , 'UoM' , 'More info'];

    }
}
