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
    public $attendancearray;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject , $attendancearray)
    {
        $this->subject = $subject;
        $this->attendancearray= $attendancearray;
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
