<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HreDetail extends Model
{
    use HasFactory;

    protected $fillable = [
    	    'histogram_billing_id',
            'name',
            'designation',
            'contact',
            'email',
            'start_date',
            'end_date'
        ];
}
