<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcn extends Model
{
    use HasFactory;

    protected $fillable = [
    	'pcn',
      'po',
      'customer_id',
    	'client_name',
    	'brand',
    	'work',
      'location',
    	'area',
    	'city',
      'pincode',
    	'state',
      'gst',
    	'proposed_start_date',
    	'proposed_end_date',
    	'approve_holidays',
      'approved_days',
    	'targeted_days',
    	'actual_start_date',
    	'actual_completed_date',
    	'hold_days',
    	'days_acheived',
    	'status',
    	'assigned_to',
      'owner'];

        public function customer()
          {
             return $this->belongsTo(Customer::class,'customer_id','id')->withTrashed();

          } 

        public function employee()
          {
             return $this->belongsTo(Employee::class,'assigned_to','user_id')->withTrashed();

          }  

         public function user()
          {
             return $this->belongsTo(Employee::class,'assigned_to','user_id')->withTrashed();

          }    

        public function indents(){
          return $this->hasMany(Intend::class,'pcn','pcn');
        }

        public function tickets(){
          return $this->hasMany(Ticket::class,'pcn','pcn');
        }   
}
