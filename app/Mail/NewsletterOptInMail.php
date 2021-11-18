<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterOptInMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $url
    )
    {
    }

    public function build(): static
    {
        /** @var string $subject */
        $subject = __('Newsletter subscription');

        return $this
            ->subject($subject)
            ->markdown('mail.newsletter.opt-in');
    }
}
