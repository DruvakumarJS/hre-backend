<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticketarray;
    public $subject ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $ticketarray , $subject)
    {
       $this->ticketarray = $ticketarray;
       $this->subject = $subject ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.tickets');
    }
   
}
