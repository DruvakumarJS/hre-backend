<?php

namespace App\Exports;

use App\Models\Indent_list;
use App\Models\Intend;
use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB;

class ExportFilteredIndents implements FromCollection , WithHeadings 
{
    private $search;
    private $filter;
   
    public function __construct($search , $filter) 
    {
        $this->search = $search;
        $this->filter = $filter;
        //print_r($IndentList);die();
       
    } 

    public function collection()
    { 
    	

    	$search = $this->search;
    	$filter = $this->filter;
    	//print_r($data);die();

    	if($filter == 'all'){
    		$filter == '';
    	}

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
        ->where('indent_lists.status','LIKE',$filter.'%')
        ->where(function($query)use($search){
	        $query->where('indent_lists.indent_no','LIKE','%'.$search.'%');
	        $query->orWhere('indent_lists.pcn','LIKE','%'.$search.'%');
	        $query->orWhereDate('indent_lists.created_at','LIKE','%'.$search.'%');
	        $query->orWhereMonth('indent_lists.created_at','LIKE','%'.$search.'%');
	        $query->orWhereYear('indent_lists.created_at','LIKE','%'.$search.'%');
	        $query->orWhereHas('indent_lists.pcns', function ($query2) use ($search) {
	            $query2->where('pcns.brand', 'like', '%'.$search.'%');
	         });
	        })
	      
	    ->orderByRaw("FIELD(indent_lists.status , 'Active', 'Completed') ASC")
        
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

        return $att ;

    } 	


    public function headings():array{
    	return ['Date','Indent Number', 'PCN', 'Billing name','Area','Material ID','Material Name', 'Brand','Information', 'Additional Description', 'Total Indent', 'Total GRN','Total Dispatch','Pending','Status'];
    }
}

