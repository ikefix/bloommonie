<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeToPOSMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tenant;
    public $plainPassword;

    public function __construct($user, $tenant, $plainPassword)
    {
        $this->user = $user;
        $this->tenant = $tenant;
        $this->plainPassword = $plainPassword;
    }

    public function build()
    {
        $url = route('pos'); // No tenant needed


        return $this->subject('Welcome to Your POS Dashboard')
            ->view('emails.welcome')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'password' => $this->plainPassword,
                'url' => $url,
            ]);
    }
}

