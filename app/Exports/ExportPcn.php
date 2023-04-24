<?php

namespace App\Exports;

use App\Models\Pcn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportPcn implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pcn::select( 'pcn', 'client_name', 'brand', 'work', 'area', 'city', 'state', 'proposed_start_date', 'proposed_end_date', 'approve_holidays', 'targeted_days', 'actual_start_date', 'actual_completed_date', 'hold_days', 'days_acheived', 'status')->get();
    }

    public function headings():array{
    	return [ 'PCN', 'Client Name', 'Brand', 'type of Work', 'Area', 'City', 'State', 'Proposed Start Date', 'Proposed End Date', 'Approve holidays', 'Targeted Days', 'Actual Start Date', 'Actual Completed Date', 'Hold Days', 'Days Acheived', 'Status'];
    }
}