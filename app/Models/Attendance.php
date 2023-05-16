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
        'total_hours',
        'proof'
    	];
}
