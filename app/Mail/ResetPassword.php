<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject(app()->isLocale('en') ? 'Reset Password' : 'إعادة تعيين كلمة المرور')
        ->view(app()->isLocale('en') ? 'mail.reset-password-en' : 'mail.reset-password-ar');
    }
}
