<?php

namespace Portfolio\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Portfolio\ConfirmEmail;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $confirm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ConfirmEmail $confirm) {
        $this->confirm = $confirm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $link = route('verify_email', ['token' => $this->confirm->token]);
        return $this->subject('Активация на сайте '
            .config('site.name'))
            ->view('layouts.mail')
            ->with([
                'name' => $this->confirm->user->first_name,
                'text_first' => view('mails.verify_email_first')->render(),
                'link' => $link,
                'text_button' => 'Активировать',
                'text_last' => view('mails.verify_email_last')
                    ->with('link', $link)->render(),
            ]);
    }
}
