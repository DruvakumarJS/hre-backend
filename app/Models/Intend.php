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

     function employee()
          {
             return $this->belongsTo(Employee::class,'user_id','user_id');

          }

     function user()
          {
             return $this->belongsTo(User::class,'user_id','id');

          }     

     function intends_list(){
            return $this->hasMany(Indent_list::class,'id', 'indent_id');
        } 

      function grn(){
            return $this->hasMany(GRN::class,'indent_no', 'indent_no');
        } 

     function pcn()
          {
             return $this->belongsTo(Pcn::class,'pcn','pcn');
          }           
    
}
