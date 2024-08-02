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
       $att = DB::table('indent_lists')
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
        DB::raw("CONCAT(indent_lists.quantity, ' ', materials.uom) AS quant"),
        DB::raw("CONCAT(indent_lists.recieved, ' ', materials.uom) AS rec"),
        DB::raw("CONCAT(SUM(g_r_n_s.dispatched), ' ', materials.uom) AS dispatched_sum"),
        DB::raw("CONCAT(indent_lists.pending, ' ', materials.uom) AS pend"),
        
        'indent_lists.status'
    )
    ->join('intends', 'indent_lists.indent_id', '=', 'intends.id')
    ->join('pcns', 'intends.pcn', '=', 'pcns.pcn')
    ->join('materials', 'indent_lists.material_id', '=', 'materials.item_code')
    ->leftJoin('g_r_n_s', 'indent_lists.id', '=', 'g_r_n_s.indent_list_id')
    ->where('indent_lists.indent_id', $this->id)
    ->orderBy('indent_lists.material_id','ASC')
    ->groupBy(
        'indent_lists.id',
        'intends.indent_no',
        'intends.pcn',
        'pcns.client_name',
        'pcns.area',
        'indent_lists.material_id',
        'materials.name',
        'materials.brand',
        'materials.information',
        'indent_lists.decription',
        'quant',
        'rec',
        'pend',
        'indent_lists.status'
    )
    ->get();

return $att;

    } 	



    public function headings():array{
    	return ['Date','Indent Number', 'PCN', 'Billing name','Area','Material ID','Material Name', 'Brand','Information', 'Indent Description', 'Total Indent', 'Total GRN','Total Dispatch','Pending','Status'];
    }
}
