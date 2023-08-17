<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PcnMail extends Mailable
{
    use Queueable, SerializesModels;
     public $pcn_data ;
     public $subject ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pcn_data , $subject)
    {
        $this->pcn_data = $pcn_data ;
        $this->subject = $subject ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.pcn');
    }
}
