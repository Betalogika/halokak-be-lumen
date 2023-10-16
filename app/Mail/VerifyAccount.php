<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email, $url, $username;

    public function __construct($data, $url)
    {
        $this->email = $data['email'];
        $this->url = $url;
        $this->username = $data['username'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verifyAccount')->with([
            'email' => $this->email,
            'username' => $this->username,
            'url' => $this->url
        ])->subject('Verifikasi Account');
    }
}
