<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histogram_billing_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'billing_name',
        'brand',
    	'gst',
    	'project_name',
    	'location',
    	'area',
    	'city',
    	'state',
    	'pincode',
    	'target_start_date',
    	'target_end_date',
    	'approved_holidays_no',
    	'holiday_dates',
    	'actual_start_date',
    	'actual_end_date',
    	'hold_days_no',
    	'hold_dates',
    	'po_date',
    	'po_number',
    	'is_dlp_applicable',
    	'dlp_days',
    	'dlp_end_date',
        'user_id',
        'pcn',
        'form_verified_by',
        'pcn_alloted_by'
    ];

    public function user(){
        return $this->belongsTo(User::class ,'user_id','id');
    }

    public function client(){
        return $this->hasMany(HistogramClientDetails::class ,'histogram_billing_id','id');
    }

    public function arch(){
        return $this->hasMany(HistogramClientDetails::class ,'histogram_billing_id','id');
    }

    public function land(){
        return $this->hasMany(HistogramClientDetails::class ,'histogram_billing_id','id');
    }

    public function vendor(){
        return $this->hasMany(HistogramClientDetails::class ,'histogram_billing_id','id');
    }
}
