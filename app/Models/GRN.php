<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;

     protected $fillable =[
     	'grn',
    	'indent_list_id',
    	'indent_no',
    	'pcn',
    	'dispatched',
        'approved',
    	'damaged',
    	'status',
    	];
}
