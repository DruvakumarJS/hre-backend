<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable=[
    	'ticket_no',
    	'pcn',
      'category',
    	'issue',
      'assigner',
    	'assigned_to',
    	'creator',
    	'status',
      'reopened',
      'priority',
      'tat',
      'comments',
      'filename'];

   function pcns()
    {
          return $this->belongsTo(Pcn::class,'pcn', 'pcn');
    }

    function conversation()
    {
          return $this->hasMany(TicketConversation::class,'id', 'ticket_id');
    }


    function user()
     {
          return $this->belongsTo(User::class,'creator', 'id')->withTrashed();
     }  

     function employee()
     {
          return $this->belongsTo(User::class,'assigned_to', 'id')->withTrashed();
      }  	
}
