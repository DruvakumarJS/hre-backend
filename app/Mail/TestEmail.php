<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

     public $indent_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($indent_details)
    {
        $this->indent_details = $indent_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

         return $this->subject('Indents requirement')->view('email.testmail');
    }
}
