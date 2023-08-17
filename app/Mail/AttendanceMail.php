<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttendanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $attendance;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject , $attendance)
    {
        $this->subject = $subject;
        $this->attendance= $attendance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email.attendance');
    }
}
