<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'area',
    	'city',
    	'state',
      'gst'];

    public function customer()
          {
             return $this->belongsTo(Customer::class,'customer_id','id');

          }	
}

