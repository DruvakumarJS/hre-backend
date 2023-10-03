<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\IndentsMail;
use Mail;

class SendIndentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $indent_details;
    public $attachment;
    public $subject;
    public $emailid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($indent_details ,  $subject ,$attachment , $emailid)
    {
         $this->indent_details = $indent_details;
         $this->subject = $subject;
         $this->attachment = $attachment;
         $this->emailid = $emailid ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       //print_r($this->emailid); die();
        Mail::to($this->emailid)->send(new IndentsMail($this->indent_details,$this->subject,$this->attachment));
    }
}
