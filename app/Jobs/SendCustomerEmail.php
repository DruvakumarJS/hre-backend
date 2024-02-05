<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\user;
use App\Mail\CustomerMail;
use Mail;

class SendCustomerEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $subject;
    protected $emailid;
    protected $details;
    protected $customer_address;
    protected $action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data , $subject , $emailid ,$action)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->emailid = $emailid;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data ;
        $subject = $this->subject;
        $action = $this->action;
      
        //Mail::to($this->emailid)->send(new CustomerMail($data ,$subject ));
        Mail::to('druva@netiapps.com')->send(new CustomerMail($data ,$subject, $action));
    }

    
}
