<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketDetailsMail extends Mailable
{
    use Queueable, SerializesModels;
     public $ticketarray;
    public $subject ;
    public $body ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketarray , $subject , $body)
    {
       $this->ticketarray = $ticketarray;
       $this->subject = $subject ;
       $this->body = $body ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.ticket_details');
    }
}
