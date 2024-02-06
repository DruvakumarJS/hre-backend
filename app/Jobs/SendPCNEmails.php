<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PcnMail;
use Mail;

class SendPCNEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     public $pcn_data ;
     public $subject ;
     public $emailid ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pcn_data , $subject , $emailid)
    {
        $this->pcn_data = $pcn_data ;
        $this->subject = $subject ;
        $this->emailid =  $emailid ;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to($this->emailid)->send(new PcnMail($this->pcn_data,$this->subject));
        //Mail::to('druva@netiapps.com')->send(new PcnMail($this->pcn_data,$this->subject));
    }
}
