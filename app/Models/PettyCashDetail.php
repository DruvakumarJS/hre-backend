<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettyCashDetail extends Model
{
    use HasFactory;

    protected $fillable =[
    	'pettycash_id',
    	'billing_no',
        'bill_date',
    	'spent_amount',
        'purpose',
        'pcn',
    	'comments',
    	'filename',
    	'isapproved',
        'remarks'
    ];

     function pettycash(){
    	return $this->belongsTo(Pettycash::class,'pettycash_id', 'id');
    }

}
