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

class GenerateNewHistogramPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
     protected $client;
     protected $arch;
     protected $land;
     protected $hre;
     protected $vendor;
     protected $filename;
     protected $name;
     protected $alias;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$client,$arch,$land,$hre,$vendor,$filename,$name,$alias)
    {
        $this->data = $data ;
        $this->client = $client ;
        $this->arch = $arch ;
        $this->land = $land ;
        $this->hre = $hre ;
        $this->vendor = $vendor ;
        $this->filename = $filename ;
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
       
        $data = $this->data ;
        $client = $this->client  ;
        $arch = $this->arch;
        $land = $this->land;
        $hre = $this->hre;
        $vendor = $this->vendor;
        $name = $this->name;
        $alias = $this->alias;

        $pdf = PDF::loadView('pdf/new_histogramPDF',compact('data','client','arch','land','hre','vendor','name','alias' ));
    
        $savepdf = $pdf->save(public_path($this->filename));
    }
}
