<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $material;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject , $material)
    {
        $this->subject = $subject;
        $this->material = $material;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.materials');
    }
}
