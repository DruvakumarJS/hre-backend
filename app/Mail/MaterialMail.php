<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialMail extends Mailable
{
    use Queueable, SerializesModels;
   public $material_data;
    public $subject;
    public $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($material_data , $subject,$action )
    {
        $this->material_data = $material_data;
        $this->subject = $subject ;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->action == 'Create'){
            return $this->subject($this->subject)->view('email.material_create');
        }
       if($this->action == 'Update'){
            return $this->subject($this->subject)->view('email.material_update');
        }
       if($this->action == 'Delete'){
            return $this->subject($this->subject)->view('email.material_delete');
        }
    }
}
