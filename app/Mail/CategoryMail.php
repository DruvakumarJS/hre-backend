<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $category_data;
    public $subject;
    public $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($category_data , $subject,$action )
    {
        $this->category_data = $category_data;
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
       // print_r($this->category_data);  die();
        if($this->action == 'Create'){
            return $this->subject($this->subject)->view('email.category_create');
        }
       if($this->action == 'Update'){
            return $this->subject($this->subject)->view('email.category_update');
        }
       if($this->action == 'Delete'){
            return $this->subject($this->subject)->view('email.category_delete');
        } 
        
    }
}
