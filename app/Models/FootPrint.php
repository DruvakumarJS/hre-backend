<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootPrint extends Model
{
    use HasFactory;
    protected $fillable = [
    	'action' ,
    	'user_id',
    	'module',
    	'operation'];

    public function user(){
	 return $this->belongsTo(Employee::class,'user_id', 'user_id');
    } 
    	
}


