<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentDiscardedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appId;
    public $program;
    public $remarks;

    public function __construct($appId, $program, $remarks)
    {
        $this->appId = $appId;
        $this->program = $program;
        $this->remarks = $remarks;
    }

    public function build()
    {
        return $this->subject('Payment Discarded - Action Required')
            ->view('emails.payment_discarded');
    }
}
