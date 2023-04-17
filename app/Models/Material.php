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
    	'uom',
    	'information'
    ];


      public function Category()
          {
             return $this->belongsTo(Category::class,'category_id','code');

          }

       public function indent_list()
          {
             return $this->hasMany(Indent_list::class,'item_code','material_id');

          }    
}
