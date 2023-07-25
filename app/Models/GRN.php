<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;

     protected $fillable =[
     	'grn',
      'user_id',
    	'indent_list_id',
    	'indent_no',
    	'pcn',
    	'dispatched',
      'dispatch_comment',
      'approved',
    	'damaged',
      'comment',
    	'status',
    	];

     function Indent_list()
      {
         return $this->belongsTo(Indent_list::class,'indent_list_id','id');

      }


      function Indent()
      {
         return $this->belongsTo(Intend::class,'indent_no','indent_no');

      }


}
