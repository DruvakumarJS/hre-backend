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
        $pcn =  DB::table('pcns')->select('created_at', 'pcn', 'client_name', 'brand', 'work', 'area', 'city', 'state', 'proposed_start_date', 'proposed_end_date', 'approve_holidays', 'targeted_days', 'actual_start_date', 'actual_completed_date', 'hold_days', 'days_acheived', 'status')->get();

        return $pcn ; 
    }

    public function headings():array{
    	return [ 'Date','PCN', 'Billing Name', 'Brand Name', 'Type of Work', 'Location', 'City', 'State', 'Proposed Start Date', 'Proposed End Date', 'Approve Holidays', 'Targeted Days', 'Actual Start Date', 'Actual Completed Date', 'Hold Days', 'Days Achieved', 'Status'];
    }
}
