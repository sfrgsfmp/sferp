<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Ipl;
use App\Species;

class MailReqIPL extends Mailable
{
    use Queueable, SerializesModels;

    public $ipl;
    

    public function __construct(Ipl $ipl)
    {
        $this->ipl = $ipl;
        // $this->species = $species;
    }

    
    public function build()
    {
        
        return $this->from('test@test.com')->subject('Request IPL')->markdown('emails.mail_req_ipl')->with(['ipl'=> $this->ipl]);

        
    }
}
