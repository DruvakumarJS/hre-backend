<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConversation extends Model
{
    use HasFactory;

    protected $fillable=[
    	'ticket_id',
    	'sender',
    	'recipient',
    	'message',
    	'status'
    ];

    function ticket(){
    	return $this->belongsTo(User::class,'ticket_id', 'ticket_id');
    }

    function mailsender(){
        return $this->belongsTo(User::class,'sender', 'id');
    }

    function mailrecipient(){
        return $this->belongsTo(User::class,'recipient', 'id');
    }
}
