<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indent_list extends Model
{
    use HasFactory;

    protected $fillable = [
    	'indent_id',
    	'material_id',
    	'decription',
    	'quantity',
    	'recieved',
    	'pending',
    	'status'
    ];

    /* public function indent()
          {
             return $this->belongsTo(Intend::class,'indent_id','id');

          }*/

    public function materials()
          {
             return $this->belongsTo(Material::class,'material_id','item_code');

          }       

}
