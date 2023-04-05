<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'category_id',
    	'name',
    	'brand',
    	'size',
    	'thickness',
    	'grade',
    	'shade_no',
    	'unit'
    ];


      public function Category()
          {
             return $this->belongsTo(Category::class,'category_id','code');

          }
}
