<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'histogram_billing_id',
        'department',
        'company_name',
        'contracter_name',
        'contracter_mobile',
        'supervisor_name',
        'supervisor_mobile',
        'start_date',
        'end_date'];

    public function histogram(){
        return $this->belongsTo(Histogram_billing_details::class ,'histogram_billing_id','id');
    }     
}
