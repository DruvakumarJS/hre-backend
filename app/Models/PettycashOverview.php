<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettycashOverview extends Model
{
    use HasFactory;

    protected $fillable =[
    	'user_id',
    	'total_issued',
    	'total_balance', 
    ];

    function employee(){
    	return $this->belongsTo(Employee::class,'user_id', 'user_id')->withTrashed();
    }

    function pettycsah_details(){
        return $this->hasMany(PettyCashDetail::class,'user_id', 'user_id');
    }

    function details(){
        return $this->hasMany(PettyCashDetail::class, 'user_id' , 'user_id');
    }

}
