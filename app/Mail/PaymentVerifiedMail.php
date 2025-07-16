<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appId;
    public $program;

    public function __construct($appId, $program)
    {
        $this->appId = $appId;
        $this->program = $program;
    }

    public function build()
    {
        return $this->subject('Application Verified')
            ->view('emails.payment_verified');
    }
}

