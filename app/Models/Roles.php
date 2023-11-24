<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'alias',
    	'description',
        'team_id'];
    	

	 public function Users()
	  {
	     return $this->hasMany(User::class,'id','role_id')->withTrashed();

	  }

    public function team()
      {
         return $this->belongs(Team::class,'id','team_id');

      }
}

     
