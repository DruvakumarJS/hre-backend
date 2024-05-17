<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PettycashMail;
use Mail;

class SendPettycashApprovalRemainder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $empl;
    public $p_data;
    public $emailid;
    public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($empl , $p_data , $emailid, $id)
    {
        $this->empl = $empl;
        $this->p_data = $p_data ;
        $this->emailid = $emailid ;
        $this->id = $id ;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $empldata = $this->empl;
         Mail::to($this->emailid)->cc($empldata->email)->send(new PettycashMail($this->p_data,$this->empl,$this->id));
         //Mail::to('druva@netiapps.com')->send(new PettycashMail($this->p_data,$this->empl,$this->id));
    }
}
