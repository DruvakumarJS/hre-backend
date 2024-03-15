<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\HistogramUpdateMail;
use App\Models\FootPrint;
use App\Models\User;
use Auth;
use PDF;
use File;   
use Mail;
use DB;

class GeneratePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $data;
     protected $client;
     protected $arch;
     protected $land;
     protected $hre;
     protected $vendor;
     protected $filename;
     protected $empl_id;
     protected $pcn;
     protected $empl_mail;
     protected $name;
     protected $alias;
     protected $subject;
     protected $emailid;
     protected $empli_name;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id ,$empli_name ,$pcn ,$empl_mail,$name , $alias , $subject , $emailid)

    {
        $this->data = $data ;
        $this->client = $client ;
        $this->arch = $arch ;
        $this->land = $land ;
        $this->hre = $hre ;
        $this->vendor = $vendor ;
        $this->filename = $filename ;
        $this->empl_id = $empl_id ;
        $this->empli_name = $empli_name ;
        $this->pcn = $pcn ;
        $this->empl_mail = $empl_mail ;
        $this->name = $name ;
        $this->alias = $alias ;
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
              
        
        $path = 'histogram' ;

        if (file_exists(public_path().'/'.$path)) {
          
        } else {
           
            File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
        }

        $data = $this->data ;
        $client = $this->client  ;
        $arch = $this->arch;
        $land = $this->land;
        $hre = $this->hre;
        $vendor = $this->vendor;
        $name = $this->name;
        $alias = $this->alias;
        $empl_id = $this->empl_id;
        $empli_name = $this->empli_name ;

        $pdf = PDF::loadView('pdf/histogramPDF',compact('data','client','arch','land','hre','vendor','name','alias' ));
    
        $savepdf = $pdf->save(public_path('histogram').'/'.$this->filename);

         if($savepdf){
       
        $subject = $this->subject;
        $id = $this->data->id ;

        $attachment = public_path($path.'/'.$this->filename) ;

        

       Mail::to($this->emailid)->cc($this->empl_mail)->send(new HistogramUpdateMail($subject , $attachment , $empli_name , $empl_id ,$id));
      //  Mail::to('druva@netiapps.com')->send(new HistogramUpdateMail($subject , $attachment ,$empli_name ,  $empl_id ,$id));



          }




       
    }
}
