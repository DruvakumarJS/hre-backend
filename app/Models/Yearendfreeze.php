<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yearendfreeze extends Model
{
    use HasFactory;

    protected $fillable=[
    	'financial_year',
    	'yearend_date',
    	'user_id',
    	'comments',
    	'isactive'
    ];
}
