<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
    	'date',
    	'user_id',
    	'login_time',
    	'login_lat',
    	'login_long',
    	'login_location',
    	'logout_time',
    	'logout_lat',
    	'logout_long',
    	'logout_location',
    	'overtime',
        'out_of_work',
        'total_hours',
        'proof',
        'logout_date'
    	];

     function user()
        {
              return $this->belongsTo(User::class,'user_id', 'id')->withTrashed();
        }

    function employee()
        {
              return $this->belongsTo(Employee::class,'user_id', 'user_id')->withTrashed();
        } 

           
}
