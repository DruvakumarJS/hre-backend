<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistogramHistory extends Model
{
    use HasFactory;

    protected $fillable = [
    	'histogram_id',
    	'pcn',
    	'user_id',
    	'submission_date',
    	'submission_time',
    	'path',
    	'filename'
    ];

    public function user(){
        return $this->belongsTo(Employee::class ,'user_id','user_id');
    }
}
