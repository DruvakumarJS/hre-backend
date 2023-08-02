<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PettycashMail extends Mailable
{
    use Queueable, SerializesModels;
   
     public $p_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($p_data)
    {
        $this->p_data=$p_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PettyCash Bill')->view('email.pettycash');
    }
}
