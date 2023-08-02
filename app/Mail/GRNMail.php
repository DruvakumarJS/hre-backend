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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($grndata)
    {
        $this->grndata = $grndata ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Indent Items dispatched')->view('email.grn');
    }
}
