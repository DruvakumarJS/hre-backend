<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettyCashDetail extends Model
{
    use HasFactory;

    protected $fillable =[
    	'user_id',
    	'billing_no',
        'bill_date',
        'bill_number',
    	'spent_amount',
        'purpose',
        'pcn',
    	'comments',
    	'filename',
    	'isapproved',
        'remarks',
        'approving_manager',
        'manager_approval'
    ];

    
    

}
