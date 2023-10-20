<?php

namespace App\Exports;

use App\Models\Pcn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class ExportPcn implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pcn =  DB::table('pcns')->select(DB::raw("DATE_FORMAT(`created_at`, '%d-%m-%Y') as date"), 'pcn', 'client_name', 'brand', 'work', 'area', 'city', 'state', 'pincode' , 'po' , 'proposed_start_date', 'proposed_end_date', 'approve_holidays','approved_days','targeted_days', 'actual_start_date', 'actual_completed_date', 'hold_days', 'days_acheived', 'dlp_date','status')->get();

        return $pcn ; 
    }

    public function headings():array{
    	return [ 'Date','PCN', 'Billing Name', 'Brand Name', 'Type of Work', 'Location', 'City', 'State', 'PINCODE', 'PO Number', 'Proposed Start Date', 'Proposed End Date', 'Approve Holidays', 'Approved Holidays', 'Targeted Days', 'Actual Start Date', 'Actual Completed Date', 'Hold Days', 'Days Achieved', 'DLP Date', 'Status'];
    }
}
