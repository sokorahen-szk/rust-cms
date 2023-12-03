<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Package\Domain\User\Entity\User;
use Package\Domain\User\Entity\UserEmailVerifyToken;
use Illuminate\Mail\Mailables\Address;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private User $user, private UserEmailVerifyToken $userEmailVerifyToken)
    {
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(
                config("mail.from.address"),
                config("app.name") . config("mail.from.name")),
            subject: "新規登録のお知らせ",
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: "mails.register",
            with: [
                "accountId" => $this->user->accountId()->value(),
                "appTitle" => config("app.name"),
                "verifyEmail" => route("register.token", ["token" => $this->userEmailVerifyToken->id()->value()]),
                "verifyExpiresMinutes" => 30,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
