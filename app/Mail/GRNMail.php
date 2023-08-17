<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GRNMail extends Mailable
{
    use Queueable, SerializesModels;
     public $grndata;
     public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($grndata , $subject)
    {
        $this->grndata = $grndata ;
         $this->subject = $subject ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject)->view('email.grn');
    }
}
