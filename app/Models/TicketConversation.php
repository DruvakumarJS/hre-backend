<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConversation extends Model
{
    use HasFactory;

    protected $fillable=[
    	'ticket_id',
        'ticket_no',
    	'sender',
    	'recipient',
    	'message',
    	'status',
        'filename'
    ];

    function ticket(){
    	return $this->belongsTo(User::class,'ticket_no', 'ticket_no')->withTrashed();
    }

    function mailsender(){
        return $this->belongsTo(User::class,'sender', 'id')->withTrashed();
    }

    function mailrecipient(){
        return $this->belongsTo(User::class,'recipient', 'id')->withTrashed();
    }
}
