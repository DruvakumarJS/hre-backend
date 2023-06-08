<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

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
             return $this->belongsTo(Category::class,'category_id','code')->withTrashed();

          }

       public function indent_list()
          {
             return $this->hasMany(Indent_list::class,'item_code','material_id');

          }    
}
