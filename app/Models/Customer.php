<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'brand',
    	'email',
    	'mobile',
    	'telephone'];

     function address(){
            return $this->hasMany(Address::class,'customer_id', 'id');
        }

      function pcn(){
            return $this->hasMany(Customer::class,'id', 'customer_id');
        }      	
}
