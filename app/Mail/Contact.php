<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    protected $say, $msg, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($say, $msg, $user)
    {
        $this->user = $user;
        $this->say = $say;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@codeals.es')
            ->view('mails.contact-send')
            ->with('subject', $this->say)
            ->with('msg', $this->msg)
            ->with('email', $this->user);
    }
}
