<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indent_tracker extends Model
{
    use HasFactory;

    protected $fillable =[
    	'indent_list_id',
    	'indent_no',
    	'pcn',
    	'quantity'
    	];
}
