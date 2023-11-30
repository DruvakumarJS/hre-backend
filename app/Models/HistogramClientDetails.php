<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistogramClientDetails extends Model
{
    use HasFactory;

    protected $fillable = [
    	'histogram_billing_id',
    	'client_name',
    	'client_designation',
    	'client_organisation',
        'client_contact',
        'client_email'];

    public function histogram(){
        return $this->belongsTo(Histogram_billing_details::class ,'histogram_billing_id','id');
    }  
    
      
}
