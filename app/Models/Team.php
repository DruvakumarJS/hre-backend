<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
    	'team',
    	'responsibilty'
    ];

    public function roles()
      {
         return $this->hasMany(Roles::class,'team_id','id');

      }
}
