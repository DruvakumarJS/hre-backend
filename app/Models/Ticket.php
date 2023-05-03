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
    	'indent_no',
      'subject',
    	'issue',
    	'assigned_to',
    	'owner',
    	'status'];

   function pcn()
    {
          return $this->belongsTo(Pcn::class,'pcn', 'pcn');
    }

    function conversation()
    {
          return $this->hasMany(TicketConversation::class,'ticket_no', 'ticket_no');
    }


    function user()
     {
          return $this->belongsTo(User::class,'owner', 'id');
     }  

     function employee()
     {
          return $this->belongsTo(User::class,'assigned_to', 'id');
      }  	
}
