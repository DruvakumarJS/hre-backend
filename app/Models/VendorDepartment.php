<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorDepartment extends Model
{
   
    use HasFactory , SoftDeletes;

    protected $fillable = [
    	'vid_id',
    	'vid',
    	'billing_name',
    	'vendor_type',
    	'gst',
    	'pan',
    	'tin',
    	'building',
    	'area',
    	'location',
    	'city',
    	'state',
        'pincode',
    	'owner',
    	'mobile',
    	'email'
    ];

    public function vendor_staffs(){
        return $this->hasMany(VendorStaff::class ,'vendor_id','id');
    }
}
