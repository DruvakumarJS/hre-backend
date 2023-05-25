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
    	'spent_amount',
    	'comments',
    	'filename',
    	'isapproved'
    ];

     function pettycash(){
    	return $this->belongsTo(Pettycash::class,'pettycash_id', 'id');
    }

}
