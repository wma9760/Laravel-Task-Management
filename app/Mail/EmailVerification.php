<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class EmailVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $User;
    public $data;

    public function __construct($data,$User)
    {
        $this->data = $data;
        $this->User = $User;
    }

    public function build()
    {
        return $this->markdown('VerificationEmail');
    }
}