<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IndentsMail extends Mailable
{
    use Queueable, SerializesModels;
     public $indent_details;
     public $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($indent_details , $filename)
    {
        $this->indent_details = $indent_details;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Order')->view('email.testmail')->attach($this->filename);
    }
    
}
