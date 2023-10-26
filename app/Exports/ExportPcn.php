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
        $pcn =  DB::table('pcns')->select(DB::raw("DATE_FORMAT(`created_at`, '%d-%m-%Y') as date"), 'pcn', 'client_name', 'brand', 'work', 'location', 'area', 'city', 'state', 'pincode' , 'gst','po' , DB::raw("DATE_FORMAT(`proposed_start_date`, '%d-%m-%Y') as proposed_start_date"), DB::raw("DATE_FORMAT(`proposed_end_date`, '%d-%m-%Y') as proposed_end_date"), 'approve_holidays','approved_days','targeted_days', DB::raw("DATE_FORMAT(`actual_start_date`, '%d-%m-%Y') as actual_start_date"), DB::raw("DATE_FORMAT(`actual_completed_date`, '%d-%m-%Y') as actual_completed_date"), 'hold_days', 'days_acheived', DB::raw("DATE_FORMAT(`dlp_date`, '%d-%m-%Y') as dlp_date"),'status')->get();

        return $pcn ; 
    }

    public function headings():array{
    	return [ 'Date','PCN', 'Billing Name', 'Brand Name', 'Type of Work', 'Location', 'Building / Area' , 'City', 'State', 'PINCODE', 'GST' , 'PO Number', 'Proposed Start Date', 'Proposed End Date', 'Approve Holidays', 'Approved Holidays', 'Targeted Days', 'Actual Start Date', 'Actual Completed Date', 'Hold Days', 'Days Achieved', 'DLP Date', 'Status'];
    }
}
