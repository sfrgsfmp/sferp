<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    

    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('test@test.com')->subject('Trying Send Email')->markdown('emails.mail')->with('data', $this->data);
    }
}
