<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HistogramUpdateMail extends Mailable
{
    use Queueable, SerializesModels;
     public $subject;
     public $attachment;
     public $name;
     public $empl_id;
     public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($subject ,$attachment,$name, $empl_id , $id)
    {
         $this->subject = $subject;
         $this->attachment = $attachment;
         $this->name = $name;
         $this->empl_id = $empl_id;
         $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // print_r($this->name.$this->empl_id); die();
        return $this->subject($this->subject)->view('email.histogramupdates')->attach($this->attachment);
    }
}
