<?php
# @Author: Codeals
# @Date:   20-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2020-01-13T16:04:08+01:00
# @Copyright: Codeals

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RechargeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $schedule, $user, $status, $err_number, $date_recharge;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($schedule, $user, $status, $err_number, $date_recharge)
    {
        $this->schedule = $schedule;
        $this->user = $user;
        $this->status = $status;
        $this->err_number = $err_number;
        // $this->date_recharge = $date_recharge;
        $day = date_create($date_recharge);
        $this->date_recharge = date_format($day, 'd/m/Y');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@tencontre.com')
            ->view('mails.recharge')
            ->subject('tEncontre')
            ->with('schedule', $this->schedule)
            ->with('status', $this->status)
            ->with('err_number', $this->err_number)
            ->with('date_recharge', $this->date_recharge)
            ->with('user', $this->user);
    }
}
