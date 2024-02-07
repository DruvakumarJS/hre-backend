<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AttendanceMail;
use Mail;

class SendAttendenceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $attendancearray;
    protected $subject;
    protected $emailid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($attendancearray , $subject , $emailid)
    {
        $this->attendancearray = $attendancearray;
        $this->subject = $subject ;
        $this->emailid = $emailid ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $att = $this->attendancearray ;
         Mail::to($this->emailid)->cc($att['employee_email'])->send(new AttendanceMail($this->subject , $this->attendancearray));
        // Mail::to('druva@netiapps.com')->send(new AttendanceMail($this->subject , $this->attendancearray));
    }
}
