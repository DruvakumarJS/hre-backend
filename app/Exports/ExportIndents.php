<?php

namespace App\Exports;

use App\Models\Indent_list;
use App\Models\Intend;
use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB;

class ExportIndents implements FromCollection , WithHeadings 
{
	private $id;
   
    public function __construct($id) 
    {
        $this->id = $id;
        //print_r($IndentList);die();
       
    } 

   

    public function collection()
    { 
       $att= DB::table('indent_lists')
        ->select(
            DB::raw("DATE_FORMAT(indent_lists.created_at, '%d-%m-%Y') as formatted_dob"),
            'intends.indent_no',
            'intends.pcn',
            'pcns.client_name',
            'pcns.area',
            'indent_lists.material_id',
            'materials.name',
            'materials.brand',
            'materials.information',
            'indent_lists.decription',
            'indent_lists.quantity',
            'indent_lists.recieved',
            'indent_lists.pending',
            'indent_lists.status'
            ) 
        ->join('intends', 'indent_lists.indent_id', '=', 'intends.id')
        ->join('pcns', 'intends.pcn', '=', 'pcns.pcn')
        ->join('materials', 'indent_lists.material_id', '=', 'materials.item_code')
        ->where('indent_id',$this->id)
        ->get();

        return $att ;
    } 	



    public function headings():array{
    	return ['Date','Indent Number', 'PCN', 'Client name','Area','Material Code','Material Name', 'Brand','Specification', 'Indent Description', 'Quantity', 'Received','Pending','Status'];
    }
}
