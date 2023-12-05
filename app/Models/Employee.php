<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
    	'user_id',
    	'employee_id',
    	'name',
    	'mobile',
    	'email',
    	'role',
        'role_id'
    	 	
    ];

   function user(){
             return $this->belongsTo(User::class,'user_id','id')->withTrashed();
          } 

    function intends(){
            return $this->hasMany(Intend::class,'user_id', 'user_id');
        } 

    function attendance(){
            return $this->hasMany(Attendance::class,'user_id', 'user_id');
        }     

    function Pcn(){
            return $this->hasMany(Pcn::class,'user_id', 'assigned_to');
        }  

      function tickets(){
            return $this->hasMany(Ticket::class,'id', 'owner');
        }  

      
      public function pettycash(){
            return $this->hasMany(Pettycash::class,'user_id', 'user_id');
        }


      public function pettycash_overview(){
            return $this->hasMany(Pettycash::class,'user_id', 'user_id');
        } 

       public function histogram_history(){
        return $this->hasMany(HistogramHistory::class,'user_id', 'user_id');
    }  

      public function footprint(){
            return $this->hasMany(FootPrint::class,'user_id', 'user_id');
        }  
           

      
}
