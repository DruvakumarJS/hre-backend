<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CategoryMail;
use Mail;


class SendMaterialCategoryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $category_data;
    public $subject;
    public $emailid;
    public $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($category_data , $subject ,$emailid,$action)
    {
        $this->category_data = $category_data;
        $this->subject = $subject ;
        $this->emailid = $emailid ;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emp = $this->category_data;
        $email = $emp['employee']['email'];
       
         Mail::to($this->emailid)->cc($email)->send(new CategoryMail($this->category_data,$this->subject,$this->action));
        // Mail::to('druva@netiapps.com')->send(new CategoryMail($this->category_data,$this->subject,$this->action));
    }
}
