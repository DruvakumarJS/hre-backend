<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\GRNMail;
use Mail;


class SendDispatchEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $grndata;
    public $subject;
    public $emailid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($grndata ,  $subject , $emailid)
    {
         $this->grndata = $grndata;
         $this->subject = $subject;
         $this->emailid = $emailid ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $grndata = $this->grndata;
        $subject = $this->subject;
       // print_r($grndata); die();
        //Mail::to($this->emailid)->cc($grndata['creator_mail'])->send(new IndentsMail($grndata,$subject));
        Mail::to('druva@netiapps.com')->cc($grndata['creator_mail'])->send(new GRNMail($grndata,$subject));

    }
}
