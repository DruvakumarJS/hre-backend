<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MaterialMail;
use Mail;

class SendMaterialsEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $material_data;
    public $subject;
    public $emailid;
    public $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($material_data , $subject ,$emailid,$action)
    {
        $this->material_data = $material_data;
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
         $emp = $this->material_data;
        $email = $emp['employee']['email'];
       
         Mail::to($this->emailid)->cc($email)->send(new MaterialMail($this->material_data,$this->subject,$this->action));
        // Mail::to('druva@netiapps.com')->send(new MaterialMail($this->material_data,$this->subject,$this->action));
    }
}
