<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pettycash extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'total',
    	'comments',
    	'spend',
    	'remaining',
    	'finance_id',
        'mode',
        'reference_number'
    ];

    function employee(){
    	return $this->belongsTo(Employee::class,'user_id', 'user_id')->withTrashed();
    }

    function pettycsah_details(){
        return $this->hasMany(PettyCashDetail::class,'id', 'pettycash_id');
    }
}
