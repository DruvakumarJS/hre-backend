<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistogramLandlordDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'histogram_billing_id',
        'land_name',
        'land_designation',
        'land_organisation',
        'land_contact',
        'land_email'];

    public function histogram(){
        return $this->belongsTo(Histogram_billing_details::class ,'histogram_billing_id','id');
    }    
}
