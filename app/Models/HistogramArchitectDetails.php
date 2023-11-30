<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistogramArchitectDetails extends Model
{
    use HasFactory;

    protected $fillable = [
    	'histogram_billing_id',
        'arc_name',
        'arc_designation',
        'arc_organisation',
        'arc_contact',
        'arc_email'];

    public function histogram(){
        return $this->belongsTo(Histogram_billing_details::class ,'histogram_billing_id','id');
    }    
}
