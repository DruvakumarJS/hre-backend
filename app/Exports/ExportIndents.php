<?php

namespace App\Exports;

use App\Models\Indent_list;
use App\Models\Intend;
use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportIndents implements FromCollection , WithHeadings 
{
	private $indent_no;
   
    public function __construct($indent_no) 
    {
        $this->indent_no = $indent_no;
        //print_r($IndentList);die();
       
    } 

    public function query()
    {
         $Indent = Intend::where('indent_no',$indent_no)->first();
         $IndentList = Indent_list::with('materials')->where('indent_id',$Indent->id)->get();
         return $IndentList ; 
    }


    public function collection()
    { 
        $Indent = Intend::where('indent_no',$this->indent_no)->first();
        return Indent_list::with('materials')->where('indent_id',$Indent->id)->get();
    } 	




   /*  public function map($IndentList): array
     {
    	print_r($IndentList);die();

        return [
            $IndentList->material_id,
            $IndentList->materials->name,
            $IndentList->materials->brand,
            $IndentList->materials->uom,
            $IndentList->materials->information,
            $IndentList->decription,
            $IndentList->quantity,
            $IndentList->recieved,
            $IndentList->pending,
            $IndentList->created_at,
            $IndentList->status,
        ];
     } 
*/

   
   /* public function collection()
    { 
    	
    	$Indent = Intend::where('indent_no',$this->indent_no)->first();
        $IndentList = Indent_list::with('materials')->where('indent_id',$Indent->id)->get();
        $data= array();

        foreach ($IndentList as $key => $value) {
            $result['Indent_no'] = $this->indent_no ; 
            $result['pcn'] = $Indent->pcn;
        	$result['material_id'] = $value->material_id ; 
        	$result['material_name'] = $value->materials->name ; 
        	$result['brand'] = $value->materials->brand ; 
        	$result['uom'] = $value->materials->uom ;
        	$result['information'] = $value->materials->information ; 
        	$result['description'] = $value->decription ; 
        	$result['request_quantity'] = $value->quantity ; 
        	$result['received'] = $value->recieved ; 
        	$result['pending'] = $value->pending ; 
        	$result['Created'] = $value->created_at ; 
        	$result['status'] = $value->status ; 
 
        	array_push($data , $result);
        	return [$this->indent_no ,$Indent->pcn , $value->material_id ,$value->materials->brand ,$value->materials->uom , $value->materials->information ,$value->decription ,$value->quantity ,$value->recieved , $value->pending , $value->created_at , $value->status];

        	
        }

     
    }*/

    public function headings():array{
    	return ['Material Code', 'Material Name', 'Brand', 'UoM', 'Information', 'Description', 'Quantity Requested', 'Received','Pending','Created on', 'Status'];
    }
}
