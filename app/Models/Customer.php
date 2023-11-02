<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'email',
        'email1',
        'email2',
        'email3',
    	'mobile',
        'mobile1',
        'mobile2',
        'mobile3',
        'full_name',
        'designation',
        'full_name1',
        'designation1',
        'full_name2',
        'designation2',
        'full_name3',
        'designation3',

    	];

     function address(){
            return $this->hasMany(Address::class,'customer_id', 'id');
        }

      function pcn(){
            return $this->hasMany(Customer::class,'id', 'customer_id');
        }      	
}
