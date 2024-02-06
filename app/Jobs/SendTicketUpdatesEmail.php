<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketDetailsMail;
use Mail;


class SendTicketUpdatesEmail implements ShouldQueue
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
      $ticketarray = $this->ticketarray ;
       
       if($ticketarray['action'] == 'assign' || $ticketarray['action'] == 'Completed' || $ticketarray['action'] == 'Resolved'){
           Mail::to($this->emailid)->cc($ticketarray['owner'])->send(new TicketDetailsMail($this->ticketarray,$this->subject));
       }
       else{
          Mail::to($this->emailid)->send(new TicketDetailsMail($this->ticketarray,$this->subject));
       }
        
       // Mail::to('druva@netiapps.com')->send(new TicketDetailsMail($this->ticketarray,$this->subject));
    }
}
