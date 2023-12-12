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
     public $attachment;
     public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($indent_details ,  $subject ,$attachment )
    {
        $this->indent_details = $indent_details;
        $this->subject = $subject;
        $this->attachment = $attachment;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.indents')->attach($this->attachment);
    }
    
}
