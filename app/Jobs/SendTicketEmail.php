<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketsMail;
use Mail;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $ticketarray;
    protected $subject;
    protected $emailid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticketarray , $subject , $emailid)
    {
        $this->ticketarray = $ticketarray;
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
        Mail::to($this->emailid)->send(new TicketsMail($this->ticketarray,$this->subject));
    }
}
