<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorStaff extends Model
{
    use HasFactory;

    protected $fillable = [
    	'vendor_id',
    	'name',
    	'designation',
    	'mobile',
    	'email'];

     public function vendors(){
        return $this->belongsTo(VendorDepartment::class ,'id','vendor_id');
    } 	
}
