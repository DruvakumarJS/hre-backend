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
use PDF;

class SendIndentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $indent_details;
    public $subject;
    public $emailid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($indent_details ,  $subject , $emailid)
    {
         $this->indent_details = $indent_details;
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
        $indent_details = $this->indent_details ;
        $subject = $this->subject ;
        $filename = 'indent.pdf';
        $attachment = public_path($filename) ;


       $pdf = PDF::loadView('pdf/indentsPDF',compact('indent_details'));
    
        $savepdf = $pdf->save(public_path($filename));

         if($savepdf){

           Mail::to($this->emailid)->send(new IndentsMail($indent_details,$subject,$attachment));

         }
    }
}
