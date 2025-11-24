<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;

    
    public function __construct($details)
    {
        $this->details = $details;
    }

    
    public function build()
    {
        return $this->subject('Nuevo mensaje de tu web')
                    ->view('emails.contact')
                    ->with([
                        'details' => $this->details,
                    ]);
    }
}
