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
        return $this
            ->subject(__('Newsletter subscription'))
            ->markdown('mail.newsletter.opt-in');
    }
}
