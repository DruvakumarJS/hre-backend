<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HistogramMail extends Mailable
{
    use Queueable, SerializesModels;
    
     public $subject;
     public $attachment;
     public $data;
     public $name;
     public $empl_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject ,$attachment,$data,$name, $empl_id)
    {
         $this->subject = $subject;
         $this->attachment = $attachment;
         $this->data = $data;
         $this->name = $name;
         $this->empl_id = $empl_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // print_r($this->subject); die();
        return $this->subject($this->subject)->view('email.histogram')->attach($this->attachment);
    }
}
