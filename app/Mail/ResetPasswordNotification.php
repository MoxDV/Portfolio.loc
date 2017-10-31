<?php

namespace Portfolio\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Portfolio\User;

class ResetPasswordNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $token;

    /**
     * Create a new message instance.
     *
     * ResetPasswordNotification constructor.
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token) {
        $this->user = $user; $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $link = route('password.reset', ['token' => $this->token]);
        return $this->subject('Сброс пароля '.config('site.name'))
            ->view('layouts.mail')
            ->with([
                'name' => $this->user->first_name,
                'text_first' => view('mails.password_reset_first')->render(),
                'link' => $link,
                'text_button' => 'Сбросить',
                'text_last' => view('mails.password_reset_last')
                    ->with('link', $link)->render(),
            ]);
    }
}
