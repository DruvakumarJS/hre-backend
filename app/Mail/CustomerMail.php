<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject;
    public $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data , $subject,$action)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->action  = $action ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        if($this->action == 'Create'){
            return $this->subject($this->subject)->view('email.customer');
        }
        else{
            return $this->subject($this->subject)->view('email.customer_edit');
        }

       
    }
}
