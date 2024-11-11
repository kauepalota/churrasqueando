<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentLink;

    public function __construct($paymentLink)
    {
        $this->paymentLink = $paymentLink;
    }

    public function build()
    {
        return $this->view('emails.payment-request')
            ->subject('Solicitação de Pagamento')
            ->with([
                'paymentLink' => $this->paymentLink,
            ]);
    }
}
