<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDepartment extends Model
{
    use HasFactory;
     protected $fillable = [
     	'department',
     	'description',
     	'roles',
     	'role_alias'];

     public function users(){
     	return $this->belongsTo(User::class , 'id','role_id');
     }	
}
