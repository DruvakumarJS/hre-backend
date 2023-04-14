<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcn extends Model
{
    use HasFactory;

    protected $fillable = [
    	'pcn',
        'customer_id',
    	'client_name',
    	'brand',
    	'work',
    	'area',
    	'city',
    	'state',
    	'proposed_start_date',
    	'proposed_end_date',
    	'approve_holidays',
    	'targeted_days',
    	'actual_start_date',
    	'actual_completed_date',
    	'hold_days',
    	'days_acheived',
    	'status',
    	'assigned_to'];

        public function customer()
          {
             return $this->belongsTo(Customer::class,'customer_id','id');

          } 
}
