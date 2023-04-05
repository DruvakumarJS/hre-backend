<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

   protected $fillable = [
   	    'code',
        'category',
        'material_category',
        'unit',
        'description',   
    ];

    function materials(){
            return $this->hasMany(materials::class,'code', 'category_id');
        }
}
