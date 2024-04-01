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
     public $empl;
     public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($p_data , $empl, $id)
    {
        $this->p_data=$p_data;
        $this->empl = $empl;
        $this->id=$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->p_data)->view('email.pettycash_request');
    }
}
