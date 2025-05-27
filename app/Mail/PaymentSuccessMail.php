<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $domain;

    public function __construct(User $user, $password, $domain)
    {
        $this->user = $user;
        $this->password = $password;
        $this->domain = $domain;
    }

    public function build()
    {
        return $this->subject('Your POS Subscription is Active')
            ->view('emails.payment_success');
    }
}
