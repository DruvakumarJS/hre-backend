<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThicknessMaster extends Model
{
    use HasFactory;

     protected $fillable = [
     	'category_id',
    	'thickness',
    	'description'];
}
