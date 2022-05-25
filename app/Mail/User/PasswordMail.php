<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public readonly string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('mail.user.password');
    }
}
