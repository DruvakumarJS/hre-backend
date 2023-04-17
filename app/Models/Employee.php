<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
    	'user_id',
    	'employee_id',
    	'name',
    	'mobile',
    	'email',
    	'role',
    	 	
    ];

    function intends(){
            return $this->hasMany(Intend::class,'user_id', 'user_id');
        } 
}
