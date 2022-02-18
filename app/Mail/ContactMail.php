<?php
# @Author: Codeals
# @Date:   21-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 31-12-2019
# @Copyright: Codeals

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subject, $message, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $user)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->message = $message;
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
            ->with('subject', $this->subject)
            ->with('message', $this->message)
            ->with('email', $this->user);
    }
}
