<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\HistogramMail;
use App\Models\FootPrint;
use App\Models\Employee;
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


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$client,$arch,$land,$hre,$vendor,$filename,$empl_id ,$pcn ,$empl_mail,$name , $alias)
    {
        $this->data = $data ;
        $this->client = $client ;
        $this->arch = $arch ;
        $this->land = $land ;
        $this->hre = $hre ;
        $this->vendor = $vendor ;
        $this->filename = $filename ;
        $this->empl_id = $empl_id ;
        $this->pcn = $pcn ;
        $this->empl_mail = $empl_mail ;
        $this->name = $name ;
        $this->alias = $alias ;
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

        $pdf = PDF::loadView('pdf/histogramPDF',compact('data','client','arch','land','hre','vendor','name','alias' ));
    
        $savepdf = $pdf->save(public_path('histogram').'/'.$this->filename);

         if($savepdf){
       
        $subject = "Histogram Updated - ".$this->empl_id." PCN - ".$this->pcn;

        $attachment = public_path($path.'/'.$this->filename) ;

        //Mail::to($this->empl_mail)->send(new HistogramMail($subject , $attachment));


          }




       
    }
}
