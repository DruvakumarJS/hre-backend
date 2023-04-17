<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intend extends Model
{
    use HasFactory;

    protected $fillable = [
    	'indent_no',
    	'pcn',
    	'user_id',
    	'quantity',
    	'recieved',
    	'pending',
    	'status'
    ];

     public function employee()
          {
             return $this->belongsTo(Employee::class,'user_id','user_id');

          }

     function intends_list(){
            return $this->hasMany(Indent_list::class,'id', 'indent_id');
        }      
    
}
